<template>
  <div class="x-top-16 relative flex flex-row items-center">
    <div
      id="textoEsqID"
      class="textoDescricao absolute -top-16 md:relative md:top-0"
    >
      LINHA
    </div>
    <div
      id="envelopeAnimaID"
      class="envelopeAnimaInter h-[400px] w-[400px] lg:h-[500px] lg:w-[500px]"
    >
      <div id="NIVEL-A" class="niveis"></div>
      <div id="NIVEL-B" class="niveis"></div>
      <div id="NIVEL-C" class="niveis"></div>
    </div>
    <div
      id="textoDirID"
      class="textoDescricao absolute -top-6 md:relative md:top-0"
    >
      PETRA
    </div>
  </div>
</template>

<script setup>
onMounted(() => {
  // body.addEventListener("wheel", myFunction(event));

  // function myFunction(event) {
  //   console.log(event.deltaY);
  // }

  let NA = document.getElementById("NIVEL-A");
  let NB = document.getElementById("NIVEL-B");
  let NC = document.getElementById("NIVEL-C");
  let titEsq = document.getElementById("textoEsqID");
  let titDir = document.getElementById("textoDirID");

  NA.style.top = 0 + "px";
  NA.style.left = 0 + "px";
  NB.style.top = 0 + "px";
  NB.style.left = 0 + "px";
  NC.style.top = 0 + "px";
  NC.style.left = 0 + "px";

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
      NA.style.top = 0 + "px";
      NA.style.left = 0 + "px";
      NB.style.top = 0 + "px";
      NB.style.left = 0 + "px";
      NC.style.top = 0 + "px";
      NC.style.left = 0 + "px";
    } else {
      if (scrollY < 300) {
        titEsq.style.left = -0.03 * scrollY + "%";
        titDir.style.right = -0.03 * scrollY + "%";
        // titEsq.style.left = -0.4 * scrollY + "px";
        // titDir.style.right = -0.6 * scrollY + "px";

        NA.style.top = aTop * scrollY + "px";
        NA.style.left = aLeft * scrollY + "px";
        NB.style.top = 0.6 * scrollY + "px";
        NB.style.left = 0 * scrollY + "px";
        NC.style.top = 0.9 * scrollY + "px";
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
#NIVEL-A {
  z-index: 3;
  background-image: url("/banner/NA.png");
  width: 100%;
  height: 100%;
  background-size: contain;
  background-repeat: no-repeat;
}
#NIVEL-B {
  z-index: 2;

  background-image: url("/banner/NB.png");
  width: 100%;
  height: 100%;
  background-size: contain;
  background-repeat: no-repeat;
}

#NIVEL-C {
  z-index: 1;

  background-image: url("/banner/NC.png");
  width: 95%;
  height: 95%;
  background-size: contain;
  background-repeat: no-repeat;
}
</style>