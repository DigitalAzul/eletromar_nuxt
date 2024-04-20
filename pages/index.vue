<template>
  <div
    class="snap-y snap-mandatory"
    :class="!showAnimation ? 'visible' : 'invisible'"
  >
    <TopoSite v-if="!showAnimation" />
    <BannerHome :class="!showAnimation ? 'opacity-100' : 'opacity-0'" />
    <Conteudo />
    <Representantes />
    <NoticiasHome />
    <NewsLetter />
    <Rodape />
  </div>
  <div>
    <VuePreloader
      background-color="#006038"
      transition-type="fade-up"
      color="#72df42"
      :loading-speed="30"
      :transition-speed="600"
      @transition-is-over="loadingIsOver"
      class="z-[999999999]"
    >
      <template v-slot="{ percent, color }">
        <transition
          name="loading-animation"
          class="z-[999999999]"
          mode="in-out"
        >
          <div
            v-if="showAnimation"
            class="flex flex-col items-center"
            :style="{ color }"
          >
            <div
              id="logoMect"
              class="top-[60px] col-span-1 h-[90px] w-[345px] animate-bounce cursor-pointer py-4"
            ></div>
            <div v-if="percent <= 100" class="text-4xl">{{ percent }}%</div>
          </div>
        </transition>
      </template>
    </VuePreloader>
  </div>
</template>

  <script setup>
//import "/assets/css/main.css";
import { VuePreloader } from "vue-preloader";
import "../node_modules/vue-preloader/dist/style.css";
import { ref } from "vue";

const showAnimation = ref(true);
const router = useRouter();

function loadingIsOver() {
  showAnimation.value = false;
  window.location.assign("/home");
}
</script>

  <style scoped>
#logoMect {
  opacity: 1;
  background: url("/img/mec_logo_verde_pdr.png");
  background-repeat: no-repeat;
  width: 345px;
  height: 90px;
  background-size: 345px 90px;
}
.animaImg-2 {
  opacity: 0;
  animation: logoPulse infinite;
  animation-delay: 0.6s;
  animation-duration: 1s;
  animation-iteration-count: 3;
}
@keyframes logoPulse {
  0% {
    opacity: 0;
  }

  100% {
    opacity: 1;
  }
}
</style>