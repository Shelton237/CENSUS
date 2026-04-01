import React, { useContext, useState } from "react";
import Link from "next/link";
import Image from "next/image";
import { useRouter } from "next/router";
import dynamic from "next/dynamic";
import { useCart } from "react-use-cart";
import { FiHome, FiUser, FiShoppingCart, FiAlignLeft } from "react-icons/fi";
import useTranslation from "next-translate/useTranslation";

//internal imports
import { getUserSession } from "@lib/auth";
import { SidebarContext } from "@context/SidebarContext";
import CategoryDrawer from "@components/drawer/CategoryDrawer";

const MobileFooter = () => {
  const [modalOpen, setModalOpen] = useState(false);
  const { toggleCartDrawer, toggleCategoryDrawer } = useContext(SidebarContext);
  const { totalItems } = useCart();
  const userInfo = getUserSession();
  const router = useRouter();
  const { t } = useTranslation("common");

  return (
    <>
      <div className="flex flex-col h-full justify-between align-middle bg-white rounded cursor-pointer overflow-y-scroll flex-grow scrollbar-hide w-full">
        <CategoryDrawer className="w-6 h-6 drop-shadow-xl" />
      </div>
      <footer className="lg:hidden fixed z-50 bottom-4 left-4 right-4 bg-white/90 backdrop-blur-md border border-emerald-100/50 shadow-2xl rounded-2xl flex items-center justify-between h-16 px-6 transition-all duration-300">
        <button
          aria-label="Menu"
          onClick={toggleCategoryDrawer}
          className="flex flex-col items-center justify-center text-gray-400 hover:text-emerald-600 transition-colors focus:outline-none"
        >
          <div className="p-2 rounded-full hover:bg-emerald-50 transition-colors duration-300">
            <FiAlignLeft className="w-6 h-6" />
          </div>
        </button>
        
        <Link
          href="/"
          aria-label="Home"
          className={`flex flex-col items-center justify-center transition-colors ${router.pathname === '/' ? 'text-emerald-600' : 'text-gray-400 hover:text-emerald-600'}`}
        >
          <div className={`p-2 rounded-full transition-all duration-300 ${router.pathname === '/' ? 'bg-emerald-50 text-emerald-600' : 'hover:bg-emerald-50'}`}>
             <FiHome className="w-6 h-6" />
          </div>
        </Link>

        <button
          aria-label="Cart"
          onClick={toggleCartDrawer}
          className="relative flex flex-col items-center justify-center text-gray-400 hover:text-emerald-600 transition-colors"
        >
          <div className="relative p-2 rounded-full hover:bg-emerald-50 transition-colors duration-300">
            <span className="absolute z-10 top-0 right-0 inline-flex items-center justify-center p-1 h-4 w-4 text-[10px] font-bold text-white bg-emerald-500 rounded-full border-2 border-white shadow-sm ring-1 ring-emerald-500">
              {totalItems || 0}
            </span>
            <FiShoppingCart className="w-6 h-6" />
          </div>
        </button>

        <div className={`flex flex-col items-center justify-center transition-colors ${router.pathname.includes('/user') ? 'text-emerald-600' : 'text-gray-400 hover:text-emerald-600'}`}>
          <div className={`p-1.5 rounded-full transition-all duration-300 ${router.pathname.includes('/user') ? 'bg-emerald-50 text-emerald-600' : 'hover:bg-emerald-50'}`}>
          {userInfo?.image ? (
            <Link href="/user/dashboard" aria-label="Dashboard" className="block w-7 h-7">
              <Image
                width={28}
                height={28}
                src={userInfo.image}
                alt="user"
                className={`rounded-full ${router.pathname.includes('/user') ? 'ring-2 ring-emerald-500 ring-offset-1' : ''}`}
              />
            </Link>
          ) : userInfo?.name ? (
            <Link
              href="/user/dashboard"
              aria-label="Dashboard"
              className={`w-7 h-7 bg-emerald-100 text-emerald-700 rounded-full flex items-center justify-center font-bold text-sm ${router.pathname.includes('/user') ? 'ring-2 ring-emerald-500 ring-offset-1' : ''}`}
            >
              {userInfo?.name[0]?.toUpperCase()}
            </Link>
          ) : (
            <Link href="/auth/login" aria-label="Login" className="block p-0.5">
              <FiUser className="w-6 h-6" />
            </Link>
          )}
          </div>
        </div>
      </footer>
    </>
  );
};

export default dynamic(() => Promise.resolve(MobileFooter), { ssr: false });
