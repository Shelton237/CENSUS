import { NextResponse } from "next/server";
import { CLIENT_ROLE } from "./constants/roles";

const USER_COOKIE = "userInfo";

const parseUserFromRequest = (request) => {
  const raw = request.cookies.get(USER_COOKIE)?.value;
  if (!raw) return null;
  try {
    return JSON.parse(raw);
  } catch (err) {
    return null;
  }
};

export function middleware(request) {
  const { pathname } = request.nextUrl;
  let response = NextResponse.next();
  
  // Protect specific user-facing routes
  const isProtectedPath = pathname.startsWith('/user') || pathname.startsWith('/order') || pathname.startsWith('/checkout');
  
  if (isProtectedPath) {
    const userInfo = parseUserFromRequest(request);
    const hasValidRole = !userInfo?.role || userInfo.role === CLIENT_ROLE;

    if (!userInfo?.token || !hasValidRole) {
      const loginUrl = new URL(`/auth/login`, request.url);
      loginUrl.searchParams.set("redirectUrl", pathname);
      return NextResponse.redirect(loginUrl);
    }
  }

  // Locale Detection Logic
  const localeCookie = request.cookies.get('NEXT_LOCALE')?.value;

  if (!localeCookie) {
    const acceptLanguage = request.headers.get('accept-language');
    let preferredLocale = 'fr'; // default
    if (acceptLanguage) {
      if (acceptLanguage.toLowerCase().includes('en')) {
        preferredLocale = 'en';
      }
    }
    response.cookies.set('NEXT_LOCALE', preferredLocale, { path: '/', maxAge: 60 * 60 * 24 * 365 });
  }

  return response;
}

export const config = {
  matcher: [
    "/((?!api|_next/static|_next/image|favicon.ico|manifest.json|sat-and-buy-favicon.png).*)",
  ],
};
