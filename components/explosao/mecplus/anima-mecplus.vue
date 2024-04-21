<template>
  <!-- ffmpeg  -i caixaDijuntor.mp4   -vf scale=500:500 -frames:v 30  out/%d.png -->
  <!-- ffmpeg  -i caixaDijuntor.mp4 -framerate 30 -pix_fmt rgba -vf  colorkey=0x000000:0.1:0.1 -pix_fmt yuva420p  -r 120 -frames:v 50  out/0/%d.png -->
  <!-- ffmpeg  -i caixaDijuntor.mp4   -vf scale=500:500 -frames:v 30  500x500.mp4 -->


  <div class="x-top-16 relative flex md:flex-row flex-col items-center justify-center">
    <div
      id="P-textoEsqID"
      class="textoDescricao absolute ztop-[calc(100vh-600px)] text-white md:relative md:top-0 hidden md:block"
    >
      LINHA
    </div>

    <!-- ANIMACAO AQUI -->
    <div class="  flex flex-row items-center justify-center ">
      <div class="animatedimage w-[400px] h-[400px] 2xl:w-[500px] 2xl:h-[500px] rotate-[0deg] flex flex-row items-center justify-center scale-[1.2] md:scale-[1.3]">
        <img
          class="anima-a"
          v-for="(item, index) in 50"
          :key="index"
          :src="'anima/0/' + item + '.png'"
        />
      </div>
    </div>
    <!-- ANIMACAO AQUI --> sUDePaOfgBKrzs

    <div
      id="P-textoDirID"
      class="textoDescricao absolute -top-6 pt-4 md:relative md:top-0 hidden md:block"
    >
      MEC-PLUS
    </div>
  </div>
</template>
      
      <script setup>

onMounted(() => {

  let titEsq = document.getElementById("P-textoEsqID");
   let titDir = document.getElementById("P-textoDirID");

   titEsq.style.left = 3.03 + "%";
   titDir.style.right = -3.03 + "%";




  let expande = true;
  const seq = document.querySelectorAll(".anima-a");

  // INICIA COIM O PRIMEIRO VISIVEL
  seq[0].style.visibility = "visible";


  let anime1 = null;
  
  let X = 0;
  let lastScroll = 0;

  window.addEventListener("scrollend", () => {
    clearInterval(anime1);
    anime1 = null;
    console.log("scroll end", anime1);
  },true);

  window.addEventListener("scroll", () => {
    let { scrollY } = window;
    // console.log(Math.round(scrollY) / 100);

    if (anime1 == null) {
      anime1 = setInterval(() => {
        seq.forEach((el) => {
          el.style.visibility = "hidden";
        });

        seq[X].style.visibility = "visible";
        //seg[X].style.visibility = 'hidden';
        if (expande) {
          if (X > 45) {
            X = 45;
            clearInterval(anime1);
            anime1 = null;
          }
          X += 1;
        } else {
          if (X < 2) {
             X = 2;
            clearInterval(anime1);
            anime1 = null;
          }
          X -= 1;
        }
        console.log("setInterval", X);
      }, 10);
    }

    if (scrollY > 0 && lastScroll <= scrollY) {
      lastScroll = scrollY;
      expande = true;
      console.log("Scrolling DOWN", X);
    } else {
      lastScroll = scrollY;
      expande = false;
      console.log("Scrolling UP", X);
    }




  // MIGRADO DO ANTERIOR

      let vW = window.innerWidth;


    if (scrollY == 0) {
      titEsq.style.left = 3.03 + "%";
      titDir.style.right = -3.03 + "%";
    } else {
      if (scrollY < 300) {
        titEsq.style.left = 3.03 - (0.03 * scrollY) + "%";
        titDir.style.right = -3.03 - (0.03 * scrollY) + "%";
        // titEsq.style.left = -0.4 * scrollY + "px";
        // titDir.style.right = -0.6 * scrollY + "px";

      }
    }

  }); // listerner scroll
  // MIGRADO DO ANTERIOR



  // window.addEventListener("scroll", () => {
  //   let { scrollY } = window;
  //   let vW = window.innerWidth;

  //   let aTop = 0;
  //   let aLeft = 0;
  //   if (vW > 1000) {
  //     aTop = -0.17;
  //     aLeft = 0.3;
  //   } else {
  //     aTop = 0.02;
  //     aLeft = 0.2;
  //   }
  //   if (scrollY == 0) {
  //     NAP.style.top = 0 + "px";
  //     NAP.style.left = 0 + "px";
  //     NBP.style.top = 0 + "px";
  //     NBP.style.left = 0 + "px";
  //     NCP.style.top = 35 + "px";
  //     NCP.style.left = 40 + "px";
  //   } else {
  //     if (scrollY < 300) {
  //       titEsq.style.left = -0.03 * scrollY + "%";
  //       titDir.style.right = -0.03 * scrollY + "%";
  //       // titEsq.style.left = -0.4 * scrollY + "px";
  //       // titDir.style.right = -0.6 * scrollY + "px";

  //       NAP.style.top = aTop * scrollY + "px";
  //       NAP.style.left = aLeft * scrollY + "px";
  //       NBP.style.top = 0.5 * scrollY + "px";
  //       NBP.style.left = 0 * scrollY + "px";
  //       NCP.style.top = 0.9 * scrollY + "px";
  //     }
  //   }
  // });
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


<style scoped>
animatedimage {
  position: relative;
  display: inline-block;
  line-height: 0;
  overflow: hidden;
}
.animatedimage > * {
  position: absolute;
  display: inline-block;
  visibility: hidden;
  border: 0;
}
</style>