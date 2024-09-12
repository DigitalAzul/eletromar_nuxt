<template>
    <div class="x-top-16 relative flex md:flex-row flex-col items-center justify-center">

      <!-- ANIMACAO AQUI -->
      <div class="relative h-screen w-screen flex flex-row items-center justify-center">
        <div
        id="P-textoEsqID-Primeiro"
        class="textoDescricao absolute ztop-[calc(100vh-600px)] text-white zmd:relative zmd:top-0 zhidden zmd:block"
      >
      Esquerdo
        <!-- {{titulo_esquerdo}} -->
      </div>
        <div
        class="animatedimage w-[600px] h-[600px] 2xl:w-[500px] 2xl:h-[500px] rotate-[0deg] flex flex-row items-center justify-center">
          <img
            class="aprimeiro"
            v-for="(item, index) in 29"
            :key="index+'a'"
            :src="'media/anima/atual/1/' + index + '.webp'"
          />
        </div>
      </div>
      <!-- ANIMACAO AQUI -->
      <div
        id="P-textoDirID-Primeiro"
        class="textoDescricao absolute z-top-6 pt-4 text-white zmd:relative zmd:top-0 zmd:block zhidden"
      >
        {{titulo_direito}}
      </div>
    </div>
  </template>
  
  
  <script setup>
import { Translation } from "vue-i18n";


    // const pronto = ref(false)
      defineProps({titulo_esquerdo:String,titulo_direito:String})
  
    const trslX1 = ref(350)
    const trslX2 = ref(250)
  
  onMounted(() => {

    
  
  
        let titEsq1 = document.getElementById("P-textoEsqID-Primeiro");
        let titDir1 = document.getElementById("P-textoDirID-Primeiro");
 
        //titEsq1.style.left = 30.03 + "%";
        titEsq1.style.transform = `translateX(-${trslX1.value}px)`;
        //titDir1.style.right = 30.03 + "%";
        titDir1.style.transform = `translateX(${trslX2.value}px)`;
  
  
  
  
        let expande = true;
        const seq1 = document.querySelectorAll(".aprimeiro");
  
   


        // INICIA COIM O PRIMEIRO VISIVEL
        seq1[0].style.visibility = "visible";
        
  
        let anime1= null;
        
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
              seq1.forEach((el) => {
                el.style.visibility = "hidden";
                console.log('ererereere');
              });
        
              seq1[X].style.visibility = "visible";
              //seg[X].style.visibility = 'hidden';
              if (expande) {
                if (X > 25) {
                  X = 25;
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
            }, 27);
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
           // titEsq1.style.left = 30.03 + "%";
           titEsq1.style.transform = `translateX(-${trslX1.value}px)`;
           titDir1.style.transform = `translateX(${trslX2.value}px)`;
           // titDir1.style.right = 30.03 + "%";
          } else {
            if (scrollY < 300) {
             // titEsq1.style.left = 30.03 - (0.01 * scrollY) + "%";
             titEsq1.style.transform = `translateX(-${ trslX1.value +(0.3 * scrollY)}px)`;
              //titDir1.style.right = 30.03 - (0.01 * scrollY) + "%";
              titDir1.style.transform = `translateX(${ trslX2.value +(0.3 * scrollY)}px)`;
              // titEsq1.style.left = -0.4 * scrollY + "px";
              // titDir1.style.right = -0.6 * scrollY + "px";
        
            }
          }
        
        }); // listerner scroll
        // MIGRADO DO ANTERIOR

  
  
  });
  
  
  // onMounted(() => {
  //   let NAP = document.getElementById("P-NIVEL-Ar");
  //   let NBP = document.getElementById("P-NIVEL-Br");
  //   let NCP = document.getElementById("P-NIVEL-Cr");
  //   let titEsq1 = document.getElementById("P-textoEsqID-RAPID");
  //   let titDir1 = document.getElementById("P-textoDirID-RAPID");
  
  //   NAP.style.top = 0 + "px";
  //   NAP.style.left = 0 + "px";
  //   NBP.style.top = 0 + "px";
  //   NBP.style.left = 0 + "px";
  //   NCP.style.top = 40 + "px";
  //   NCP.style.left = 0 + "px";
  
  //   titEsq.style.left = -0.03 + "%";
  //   titDir1.style.right = -0.03 + "%";
  
  //   window.addEventListener("scroll", () => {
  //     let { scrollY } = window;
  //     let vW = window.innerWidth;
  
  //     let aTop = 0;
  //     let aLeft = 0;
  //     if (vW > 1000) {
  //       aTop = -0.17;
  //       aLeft = 0.3;
  //     } else {
  //       aTop = 0.02;
  //       aLeft = 0.2;
  //     }
  //     if (scrollY == 0) {
  //       NAP.style.top = 0 + "px";
  //       NAP.style.left = 0 + "px";
  //       NBP.style.top = 0 + "px";
  //       NBP.style.left = 0 + "px";
  //       NCP.style.top = 40 + "px";
  //       NCP.style.left = 0 + "px";
  //     } else {
  //       if (scrollY < 300) {
  //         titEsq.style.left = -0.03 * scrollY + "%";
  //         titDir1.style.right = -0.03 * scrollY + "%";
  //         // titEsq.style.left = -0.4 * scrollY + "px";
  //         // titDir1.style.right = -0.6 * scrollY + "px";
  
  //         NAP.style.top = aTop * scrollY + "px";
  //         NAP.style.left = aLeft * scrollY + "px";
  //         NBP.style.top = 0.5 * scrollY + "px";
  //         NBP.style.left = 0 * scrollY + "px";
  //         NCP.style.top = 0.9 * scrollY + "px";
  //       }
  //     }
  //   });
  // });
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
      font-size: 30pt;
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
  #P-NIVEL-Ar {
    z-index: 3;
    background-image: url("./NA.png");
    width: 90%;
    height: 90%;
    background-size: contain;
    background-repeat: no-repeat;
  }
  #P-NIVEL-Br {
    z-index: 2;
  
    background-image: url("./NB.png");
    width: 90%;
    height: 90%;
    background-size: contain;
    background-repeat: no-repeat;
  }
  
  #P-NIVEL-Cr {
    z-index: 1;
    top: 40px;
    background-image: url("./NC.png");
    width: 85%;
    height: 85%;
    background-size: contain;
    background-repeat: no-repeat;
    opacity: 1;
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