import { createI18n } from "vue-i18n";
import pt from "../locales/pt.json";
import en from "../locales/en.json";
import es from "../locales/es.json";

export default defineNuxtPlugin(({ vueApp }) => {
  const i18n = createI18n({
    legacy: false,
    globalInjection: true,
    locale: "pt",
    messages: {
      pt,
      en,
      es,
    },
  });

  vueApp.use(i18n);
});
