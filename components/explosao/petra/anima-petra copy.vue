<!-- <template>
  <div class="x-top-16 relative flex flex-row items-center">
    <div
      id="P-textoEsqID-PETRA"
      class="textoDescricao absolute -top-16 md:relative md:top-0"
    >
      LINHA
    </div>
    <div
      id="envelopeAnimaIDRapid"
      class="envelopeAnimaInter h-[400px] w-[400px] lg:h-[530px] lg:w-[500px]"
    >
      <div id="P-NIVEL-Ap" class="niveis"></div>
      <div id="P-NIVEL-Bp" class="niveis"></div>
      <div id="P-NIVEL-Cp" class="niveis"></div>
    </div>
    <div
      id="P-textoDirID-PETRA"
      class="textoDescricao absolute -top-6 pt-4 md:relative md:top-0"
    >
      PETRA
    </div>
  </div>
</template>
      
      <script setup>
onMounted(() => {
  let NAP = document.getElementById("P-NIVEL-Ap");
  let NBP = document.getElementById("P-NIVEL-Bp");
  let NCP = document.getElementById("P-NIVEL-Cp");
  let titEsq = document.getElementById("P-textoEsqID-PETRA");
  let titDir = document.getElementById("P-textoDirID-PETRA");

  NAP.style.top = 0 + "px";
  NAP.style.left = 0 + "px";
  NBP.style.top = 0 + "px";
  NBP.style.left = 0 + "px";
  NCP.style.top = 0 + "px";
  NCP.style.left = 0 + "px";

  titEsq.style.left = -0.03 + "%";
  titDir.style.right = -0.03 + "%";

  window.addEventListener("scroll", () => {
    let { scrollY } = window;
    let vW = window.innerWidth;

    let aTop = 0;
    let aLeft = 0;
    if (vW > 1000) {
      aTop = -0.17;
      aLeft = 0.3;
    } else {
      aTop = 0.02;
      aLeft = 0.2;
    }
    if (scrollY == 0) {
      NAP.style.top = 0 + "px";
      NAP.style.left = 0 + "px";
      NBP.style.top = 0 + "px";
      NBP.style.left = 0 + "px";
      NCP.style.top = 0 + "px";
      NCP.style.left = 0 + "px";
    } else {
      if (scrollY < 300) {
        titEsq.style.left = -0.03 * scrollY + "%";
        titDir.style.right = -0.03 * scrollY + "%";
        // titEsq.style.left = -0.4 * scrollY + "px";
        // titDir.style.right = -0.6 * scrollY + "px";

        NAP.style.top = aTop * scrollY + "px";
        NAP.style.left = aLeft * scrollY + "px";
        NBP.style.top = 0.6 * scrollY + "px";
        NBP.style.left = 0 * scrollY + "px";
        NCP.style.top = 0.9 * scrollY + "px";
      }
    }
  });
});
</script>
      
      <style scoped>
@media screen and (max-width: 1000px) {
  .textoDescricao {
    font-size: 30pt;
  }

  /* TEXTO ESQUERDO */

  #textoEsqID {
    animation: paraDir 1s ease forwards;
  }

  @keyframes paraDir {
    from {
      opacity: 0.3;

      transform: rotate(0deg) translateX(-100%);
    }
    to {
      opacity: 1;

      transform: rotate(0deg) translateX(40%);
    }
  }

  /* TEXTO DIREITO */

  #textoDirID {
    animation: paraEsq 1s ease forwards;
  }

  @keyframes paraEsq {
    from {
      opacity: 0.3;
      transform: rotate(0deg) translateX(100%);
    }
    to {
      opacity: 1;
      transform: rotate(0deg) translateX(-20%);
    }
  }
}

@media screen and (min-width: 1000px) {
  .textoDescricao {
    font-size: 40pt;
  }
}
@media screen and (min-width: 1200px) {
  .textoDescricao {
    font-size: 40pt;
  }

  #textoEsqID {
    animation: paraDir 1s ease forwards;
  }
  @keyframes paraDir {
    from {
      opacity: 0.3;
      transform: rotate(0deg) translateX(-100%);
    }
    to {
      opacity: 1;

      transform: rotate(0deg) translateX(0%);
    }
  }

  /* PARA ESQUEDA */

  #textoEsqID {
    animation: paraDir 1s ease forwards;
  }
  @keyframes paraEsq {
    from {
      opacity: 0.3;
      transform: rotate(0deg) translateX(100%);
    }
    to {
      opacity: 1;
      transform: rotate(0deg) translateX(20%);
    }
  }
}

.textoDescricao {
  --font-size: 40pt;
  letter-spacing: 1rem;
  font-weight: 400;
  color: #ffff;
}
#textoEsqID {
  animation: paraDir 1s ease forwards;
  left: 0%;
}
#textoDirID {
  right: 0%;
  animation: paraEsq 1s ease forwards;
}

.envelopeAnimaInter {
  position: relative;
  /* width: 900px;
        height: 900px; */
  display: flex;
  flex-direction: column;
}

.niveis {
  position: absolute;
}
#P-NIVEL-Ap {
  z-index: 3;
  background-image: url("./NA.png");
  width: 100%;
  height: 100%;
  background-size: contain;
  background-repeat: no-repeat;
}
#P-NIVEL-Bp {
  z-index: 2;

  background-image: url("./NB.png");
  width: 100%;
  height: 100%;
  background-size: contain;
  background-repeat: no-repeat;
}

#P-NIVEL-Cp {
  z-index: 1;

  background-image: url("./NC.png");
  width: 95%;
  height: 95%;
  background-size: contain;
  background-repeat: no-repeat;
}
</style> -->