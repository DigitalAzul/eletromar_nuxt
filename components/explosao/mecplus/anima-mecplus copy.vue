<template>
  <div class="x-top-16 relative flex flex-row items-center">
    <div
      id="P-textoEsqID"
      class="textoDescricao absolute -top-16 md:relative md:top-0"
    >
      LINHA
    </div>
    <div
      id="envelopeAnimaID"
      class="envelopeAnimaInter h-[400px] w-[400px] lg:h-[530px] lg:w-[500px]"
    >
      <div id="P-NIVEL-A" class="niveis"></div>
      <div id="P-NIVEL-B" class="niveis"></div>
      <div id="P-NIVEL-C" class="niveis"></div>
    </div>
    <div
      id="P-textoDirID"
      class="textoDescricao absolute -top-6 pt-4 md:relative md:top-0"
    >
      MEC-PLUS
    </div>
  </div>
</template>
      
      <script setup>
onMounted(() => {
  let NAP = document.getElementById("P-NIVEL-A");
  let NBP = document.getElementById("P-NIVEL-B");
  let NCP = document.getElementById("P-NIVEL-C");
  let titEsq = document.getElementById("P-textoEsqID");
  let titDir = document.getElementById("P-textoDirID");

  NAP.style.top = 0 + "px";
  NAP.style.left = 0 + "px";
  NBP.style.top = 0 + "px";
  NBP.style.left = 0 + "px";
  NCP.style.top = 35 + "px";
  NCP.style.left = 40 + "px";

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
      NCP.style.top = 35 + "px";
      NCP.style.left = 40 + "px";
    } else {
      if (scrollY < 300) {
        titEsq.style.left = -0.03 * scrollY + "%";
        titDir.style.right = -0.03 * scrollY + "%";
        // titEsq.style.left = -0.4 * scrollY + "px";
        // titDir.style.right = -0.6 * scrollY + "px";

        NAP.style.top = aTop * scrollY + "px";
        NAP.style.left = aLeft * scrollY + "px";
        NBP.style.top = 0.5 * scrollY + "px";
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
/*
      @keyframes paraEsq {
        from {
          opacity: 0.3;
          transform: rotate(0deg) translateX(100%);
        }
        to {
          opacity: 1;
          transform: rotate(0deg) translateX(70px);
        }
      } */

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
#P-NIVEL-A {
  z-index: 3;
  background-image: url("./NA.png");
  width: 100%;
  height: 100%;
  background-size: contain;
  background-repeat: no-repeat;
}
#P-NIVEL-B {
  z-index: 2;

  background-image: url("./NB.png");
  width: 100%;
  height: 100%;
  background-size: contain;
  background-repeat: no-repeat;
}

#P-NIVEL-C {
  z-index: 1;
  top: 35px;
  left: 40px;
  background-image: url("./NC.png");
  width: 85%;
  height: 85%;
  background-size: contain;
  background-repeat: no-repeat;
}
</style>