import { defineNuxtConfig } from "nuxt/config";

import { colors } from "@indielayer/ui";
// https://nuxt.com/docs/api/configuration/nuxt-config

const isDev = false;
export default defineNuxtConfig({
  debug: true,
  mode: "universal",
  target: "static",
  loading: true,
  css: ["~/assets/css/main.css"],
  plugins: ["~/plugins/quillEditor.client.ts"],
  postcss: {
    plugins: {
      "postcss-import": {},
      "tailwindcss/nesting": {},
      tailwindcss: {},
      autoprefixer: {},
    },
  },
  nitro: {
    // EM DEV ;; target: "https://www.global.adm.br",
    devProxy: {
      "/api": {
        target: "http://192.168.0.100/mec",
        //target: "/api/",
        changeOrigin: true,
        prependPath: true,
      },
    },
    // devProxy: {
    //   "/api": {
    //     target: isDev ? "/api/" : "https://www.global.adm.br/v2/api",
    //     changeOrigin: true,
    //     prependPath: true,
    //   },
    // },
  },

  // / EM PROD
  // app: {
  //   baseURL: "/v2/ui",
  // },

  modules: [
    [
      "@indielayer/ui/nuxt",

      {
        prefix: "X",
        theme: {
          colors: {
            primary: colors.emerald,
            secondary: colors.slate,
            success: colors.green,
            warning: colors.yellow,
            error: colors.red,
          },
        },
      },
    ],
    "nuxt-vue3-google-signin",
    "vue-recaptcha/nuxt",
    "nuxt3-meta-pixel",
  ],
  facebook: {
    /* module options */
    track: "PageView",
    pixelId: "1083901202666335",
    autoPageView: true,
    disabled: false,
  },

  googleSignIn: {
    clientId:
      "471700107010-eekuq4mud578tjum8cd7pr10qc2ddpj6.apps.googleusercontent.com",
  },
  runtimeConfig: {
    public: {
      recaptcha: {
        v2SiteKey: "6LedFEYnAAAAAOkGYGfg37_DeeG6ZxZLLJtK_hw2",
      },
    },
  },
  vite: {
    ssr: {
      noExternal: ["@googlemaps/js-api-loader"],
    },
    resolve: {
      alias: [
        {
          find: "vue-i18n",
          replacement: "vue-i18n/dist/vue-i18n.cjs.js",
        },
      ],
    },
  },
  buildModules: ["@nuxtjs/google-fonts", "nuxt-gsap-module"],
  googleFonts: {
    download: true,
    base64: true,
    stylePath: "assets/css/fonts.css",
    display: "swap",
    families: {
      Montserrat: true,
      "sans+serif": true,
      Raleway: {
        wght: [100, 300, 400, 500, 600, 700, 800],
        ital: [100],
      },
    },
  },
  build: {
    transpile: ["gsap", "vue-recaptcha"],
  },
  gsap: {
    extraPlugins: {
      scrollTo: true,
      scrollTrigger: true,
    },
    extraEases: {
      expoScaleEase: true,
    },
  },
  head: {
    title: " Mectronic | Eletromar ",
    meta: [
      { charset: "utf-8" },
      { name: "viewport", content: "width=device-width, initial-scale=1" },
    ],
  },

  // head: {
  //   title: " Mectronic | Eletromar ",
  //   meta: [
  //     { charset: "utf-8" },
  //     { name: "viewport", content: "width=device-width, initial-scale=1" },
  //   ],
  //   link: [
  //     {
  //       rel: "stylesheet",
  //       hfer: "/mapsvg/css/nanoscroller.css",
  //     },
  //   ],
  //   script: [
  //     {
  //       src: "https://code.jquery.com/jquery-3.3.1.slim.min.js",
  //       type: "text/javascript",
  //     },
  //     {
  //       src: "/mapsvg/js/jquery.js",
  //       type: "text/javascript",
  //     },
  //     {
  //       src: "/mapsvg/js/jquery.mousewheel.min.js",
  //       type: "text/javascript",
  //     },
  //     {
  //       src: "/mapsvg/js/jquery.nanoscroller.min.js",
  //       type: "text/javascript",
  //     },
  //     {
  //       src: "/mapsvg/js/mapsvg.min.js",
  //       type: "text/javascript",
  //     },
  //   ],
  // },
});
