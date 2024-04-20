<template>
  <div class="x-top-16 relative flex flex-row items-center">
    <div
      id="P-textoEsqID-PRISMA"
      class="textoDescricao absolute -top-16 md:relative md:top-0"
    >
      LINHA
    </div>
    <div
      id="envelopeAnimaIDRapid"
      class="envelopeAnimaInter h-[400px] w-[400px] lg:h-[500px] lg:w-[500px]"
    >
      <div id="P-NIVEL-Apr" class="niveis"></div>
      <div id="P-NIVEL-Bpr" class="niveis"></div>
      <div id="P-NIVEL-Cpr" class="niveis"></div>
    </div>
    <div
      id="P-textoDirID-PRISMA"
      class="textoDescricao absolute -top-6 md:relative md:top-0"
    >
      PRISMA
    </div>
  </div>
</template>
      
      <script setup>
onMounted(() => {
  let NAP = document.getElementById("P-NIVEL-Apr");
  let NBP = document.getElementById("P-NIVEL-Bpr");
  let NCP = document.getElementById("P-NIVEL-Cpr");
  let titEsq = document.getElementById("P-textoEsqID-PRISMA");
  let titDir = document.getElementById("P-textoDirID-PRISMA");

  NAP.style.top = -20 + "px";
  NAP.style.left = -10 + "px";
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
#P-NIVEL-Apr {
  z-index: 3;
  background-image: url("./NA.png");
  width: 110%;
  height: 110%;
  background-size: contain;
  background-repeat: no-repeat;
}
#P-NIVEL-Bpr {
  z-index: 2;

  background-image: url("./NB.png");
  width: 50%;
  height: 50%;
  background-size: contain;
  background-repeat: no-repeat;
}

#P-NIVEL-Cpr {
  z-index: 1;

  background-image: url("./NC.png");
  width: 95%;
  height: 95%;
  background-size: contain;
  background-repeat: no-repeat;
}
</style>