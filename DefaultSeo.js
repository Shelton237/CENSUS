import { NextSeo } from "next-seo";
import { useTranslation } from "next-translate";
import { useRouter } from "next/router";
import useAsync from "@hooks/useAsync";
import SettingServices from "@services/SettingServices";

const DefaultSeo = () => {
  const { t } = useTranslation("common");
  const { locale } = useRouter();
  const {
    data: globalSetting,
    loading,
    error,
  } = useAsync(SettingServices.getGlobalSetting);

  const title = t("SEO_Title") !== "SEO_Title" ? t("SEO_Title") : (globalSetting?.meta_title || "Sat & Buy – Marketplace & services énergétiques");
  const description = t("SEO_Desc") !== "SEO_Desc" ? t("SEO_Desc") : (globalSetting?.meta_description || "Boutique Sat & Buy : solutions solaires, équipements et prestations énergie.");
  return (
    <NextSeo
      title={title}
      description={description}
      openGraph={{
        type: "website",
        locale: locale === "fr" ? "fr_FR" : "en_US",
        url: globalSetting?.meta_url || "https://satandbuy.dreamsdigital.cm/",
        site_name: title,
        description: description,
      }}
      twitter={{
        handle: "@handle",
        site: "@site",
        cardType: "summary_large_image",
      }}
      additionalMetaTags={[
        {
          name: "viewport",
          content:
            "minimum-scale=1, initial-scale=1, width=device-width, shrink-to-fit=no, viewport-fit=cover",
        },
        {
          name: "apple-mobile-web-app-capable",
          content: "yes",
        },
        {
          name: "mobile-web-app-capable",
          content: "yes",
        },
        {
          name: "theme-color",
          content: "#059669",
        },
      ]}
      additionalLinkTags={[
        {
          rel: "apple-touch-icon",
          href: "/sat-and-buy-favicon.png",
        },
        {
          rel: "manifest",
          href: "/manifest.json",
        },
        {
          rel: "icon",
          href: "/sat-and-buy-favicon.png",
        },
      ]}
    />
  );
};

export default DefaultSeo;
