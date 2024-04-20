<template>
  <div>
    <div class="relative left-10 h-[1000px] w-[1000px] bg-red-700">
      <h1 class="text-white">dflkdsjlkfjds</h1>
      <div class="drawLine">
        <div
          class="draw-line-inner"
          style="
            will-change: transform;
            transform: translate3d(0px, -100%, 0px) scale3d(1, 1, 1)
              rotateX(0deg) rotateY(0deg) rotateZ(0deg) skew(0deg, 0deg);
            transform-style: preserve-3d;
          "
        ></div>
      </div>
    </div>
    <div class="relative h-[2000px] bg-slate-500"></div>
  </div>
</template>

<script setup>
let linhaVisivel = ref(false);

onMounted(() => {
  const orb = document.querySelector(".drawLine"),
    ease = 0.05,
    start_position = orb.offsetTop;
  const orb2 = document.querySelector(".draw-line-inner");

  var observer = new IntersectionObserver(
    function (entries) {
      // isIntersecting is true when element and viewport are overlapping
      // isIntersecting is false when element and viewport don't overlap
      if (entries[0].isIntersecting === true) linhaVisivel = true;
    },
    { threshold: [0] }
  );

  observer.observe(document.querySelector(".drawLine"));

  /////
  //var space = $(document).height() - (div.offset().top + div.height());

  let DocH = document.body.offsetHeight;
  let scrollHTotal = document.body.scrollHeight;
  let OffTop = orb.offsetTop;

  let HeigthElemento = orb.offsetHeight;

  // console.log(
  //   "scrollHTotal - OffTop + HeigthElemento",
  //   scrollHTotal - OffTop + HeigthElemento
  // );

  /////

  let scroll_request = 0,
    total_offset = 0,
    animation_running = false;

  function animate_scroll() {
    if (!linhaVisivel) {
      return;
    }

    let scrollTop = orb.scrollTop;
    // console.log(
    //   "DocH, scrollHTotal, OffTop, scrollTop, HeigthElemento",
    //   DocH,
    //   scrollHTotal,
    //   OffTop,
    //   orb.scrollTop,
    //   HeigthElemento
    // );
    let { scrollY } = window;
    //console.log("scrollY, OffTop", scrollY, OffTop);

    //console.log("scroll_request", scroll_request);
    if (scroll_request < 100) {
      scroll_request++;

      orb2.style.transform = `translate3d(0, ${scroll_request}%, 0)`;
    }

    if (!animation_running) {
      animation_running = true;
      // animation_loop();
    }

    function animation_loop() {
      let current_offset = window.pageYOffset;

      let difference = current_offset - total_offset;
      difference *= ease;

      if (Math.abs(difference) < 0.05) {
        scroll_request = 0;

        total_offset = current_offset;
        animation_running = false;
        return;
      }

      orb.style.top = `${start_position - total_offset}px`;
      total_offset += difference;

      requestAnimationFrame(animation_loop);
    }
  }

  window.addEventListener("scroll", animate_scroll);
});
</script>

<style scoped>
.drawLine {
  position: absolute;
  left: 50%;
  top: auto;
  right: auto;
  bottom: 50px;
  overflow: hidden;
  width: 1px;
  height: 220px;
}
.draw-line-inner {
  width: 1px;
  height: 100%;
  background-color: hsla(0, 0%, 100%, 0.6);
}
</style>
