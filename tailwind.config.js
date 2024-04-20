/** @type {import('tailwindcss').Config} */

const colors = require("tailwindcss/colors");
const indielayer = require("@indielayer/ui/tailwind.preset");

module.exports = {
  darkMode: "class",
  presets: [indielayer()],
  content: [
    "./components/**/*.{js,vue,ts}",
    "./layouts/**/*.vue",
    "./pages/**/*.vue",
    "./plugins/**/*.{js,ts}",
    "./nuxt.config.{js,ts}",
    "./app.vue",
    "./index.html",
    "./**/*.vue",
    "./src/**/*.{vue,js,ts,jsx,tsx}",
    "node_modules/@indielayer/ui/**/*",
    "node_modules/flowbite-vue/**/*.{js,jsx,ts,tsx}",
    "node_modules/flowbite/**/*.{js,jsx,ts,tsx}",
  ],
  theme: {
    extend: {
      screens: {
        "3xl": "1600px",
        "4xl": "2000px",
        "FHD": "1920px",
      },
      fontFamily: {
        montserrat: ["Montserrat"],
      },
      colors: {
        primary: colors.emerald,
        secondary: colors.slate,
        success: colors.green,
        warning: colors.yellow,
        error: colors.red,
      },
    },
  },
  plugins: [require("flowbite/plugin")],
};
