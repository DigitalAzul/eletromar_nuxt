<template>
  <div class="scpace-x-3 flex flex-row">
    <div COLUNA="1" class="h-screen w-[400px] border-r-2 p-6">
      <div class="p-4 text-center text-3xl">BACKGROUND BANNERS</div>
      <x-tab-group v-model="tab" class="pb-10" grow variant="line">
        <x-tab value="a" label="Cadastro/Edição">
          <div class="w-[400px] pt-10">
            <form @submit.prevent="formRequestCat">
              <div class="flex flex-col space-y-3">
                <div class="w-[90%] border bg-yellow-200">
                  <div class="flex flex-row items-center justify-between">
                    <p class="p-3 py-4">BACKGROUND BANNER 1</p>
                    <p
                      class="cursor-pointer bg-black p-5 text-white hover:bg-slate-800"
                      @click="() => resetImagTag(1)"
                    >
                      X
                    </p>
                  </div>
                  <label
                    for="imgTag-1"
                    class="cursor-pointer bg-slate-500 px-4 py-4 text-white"
                  >
                    Selecionar Arquivo
                  </label>
                  <input
                    accept="image/jpeg"
                    id="imgTag-1"
                    class="hidden"
                    type="file"
                    name="bg-1"
                    onchange="document.getElementById('bg-1').src = window.URL.createObjectURL(this.files[0])"
                  />
                </div>

                <div class="w-[90%] border bg-yellow-200">
                  <div class="flex flex-row items-center justify-between">
                    <p class="p-3 py-4">BACKGROUND BANNER 2</p>
                    <p
                      class="cursor-pointer bg-black p-5 text-white hover:bg-slate-800"
                      @click="() => resetImagTag(2)"
                    >
                      X
                    </p>
                  </div>
                  <label
                    for="imgTag-2"
                    class="cursor-pointer bg-slate-500 px-4 py-4 text-white"
                  >
                    Selecionar Arquivo
                  </label>
                  <input
                    accept="image/jpeg"
                    id="imgTag-2"
                    class="hidden"
                    type="file"
                    name="bg-2"
                    onchange="document.getElementById('bg-2').src = window.URL.createObjectURL(this.files[0])"
                  />
                </div>

                <div class="w-[90%] border bg-yellow-200">
                  <div class="flex flex-row items-center justify-between">
                    <p class="p-3 py-4">BACKGROUND BANNER 3</p>
                    <p
                      class="cursor-pointer bg-black p-5 text-white hover:bg-slate-800"
                      @click="() => resetImagTag(3)"
                    >
                      X
                    </p>
                  </div>
                  <label
                    for="imgTag-3"
                    class="cursor-pointer bg-slate-500 px-4 py-4 text-white"
                  >
                    Selecionar Arquivo
                  </label>
                  <input
                    accept="image/jpeg"
                    id="imgTag-3"
                    class="hidden"
                    type="file"
                    name="bg-3"
                    onchange="document.getElementById('bg-3').src = window.URL.createObjectURL(this.files[0])"
                  />
                </div>
              </div>

              <!-- <div class="flex w-[90%] flex-row justify-between pt-10">
                <x-button color="#000" light> Salvar </x-button>

                <x-button @click="resetImagTag(0)" color="#000" light
                  >Cancelar</x-button
                >
              </div> -->
            </form>
          </div>
        </x-tab>
      </x-tab-group>
    </div>
    <!-- TAB A COLUNA 2A -->
    <div
      COLUNA="2A"
      class="h-screen w-[1000px] overflow-y-auto overflow-x-hidden p-10"
    >
      <div class="w-[99%] overflow-hidden">
        <div>
          <div class="flex flex-col gap-5">
            <div class="flex flex-row gap-3">
              <div>
                <p>Banner 1</p>
                <div class="h-[255px] w-[450px] overflow-clip bg-slate-300">
                  <img id="bg-1" class="w-[900px] object-fill" />
                </div>
                <button
                  @click="() => sendFileBg(1)"
                  class="mt-2 w-full bg-slate-100 p-2 hover:bg-slate-200"
                >
                  Salvar
                </button>
              </div>
              <div>
                <p>Banner 1 Atual</p>
                <div class="h-[255px] w-[450px] overflow-clip bg-slate-300">
                  <img
                    src="/img/bg_banner_1.jpg"
                    id="bg-1-a"
                    class="w-[450px] object-fill"
                  />
                </div>
              </div>
            </div>

            <div class="flex flex-row gap-3">
              <div>
                <p>Banner 2</p>
                <div class="h-[255px] w-[450px] overflow-clip bg-slate-300">
                  <img id="bg-2" class="w-[900px] object-fill" />
                </div>
                <button
                  @click="() => sendFileBg(2)"
                  class="mt-2 w-full bg-slate-100 p-2 hover:bg-slate-200"
                >
                  Salvar
                </button>
              </div>
              <div>
                <p>Banner 2 Atual</p>
                <div class="h-[255px] w-[450px] overflow-clip">
                  <img
                    src="/img/bg_banner_2.jpg"
                    id="bg-2-a"
                    class="w-[450px] object-fill"
                  />
                </div>
              </div>
            </div>

            <div class="flex flex-row gap-3">
              <div>
                <p>Banner 3</p>
                <div class="h-[255px] w-[450px] overflow-clip bg-slate-300">
                  <img id="bg-3" class="w-[900px] object-fill" />
                </div>
                <button
                  @click="() => sendFileBg(3)"
                  class="mt-2 w-full bg-slate-100 p-2 hover:bg-slate-200"
                >
                  Salvar
                </button>
              </div>
              <div>
                <p>Banner 3 Atual</p>
                <div class="h-[255px] w-[450px] overflow-clip">
                  <img
                    src="/img/bg_banner_3.jpg"
                    id="bg-3-a"
                    class="w-[450px] object-fill"
                  />
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import {
  createUI,
  XAlert,
  XButton,
  XTab,
  XTabGroup,
  XTable,
  XTextarea,
} from "@indielayer/ui";
components: {
  createUI, XButton, XAlert, XTextarea, XTab, XTabGroup, XTable;
}

let tab = ref("a");

function resetImagTag(idTag) {
  switch (idTag) {
    case 1:
      console.log("case 1", idTag);
      document.getElementById("bg-1").src = "";
      document.getElementById("imgTag-1").value = "";

      break;
    case 2:
      document.getElementById("bg-2").src = "";
      document.getElementById("imgTag-2").value = "";
      break;
    case 3:
      document.getElementById("bg-3").src = "";
      document.getElementById("imgTag-3").value = "";
      break;
    case 0:
      document.getElementById("bg-1").src = "";
      document.getElementById("imgTag-1").value = "";
      document.getElementById("bg-2").src = "";
      document.getElementById("imgTag-2").value = "";
      document.getElementById("bg-3").src = "";
      document.getElementById("imgTag-3").value = "";
      break;
    default:
      break;
  }
}

let formBgBanner = new FormData();
function sendFileBg(idTag) {
  let arq;
  let arqData;
  formBgBanner = new FormData();

  switch (idTag) {
    case 1:
      arq = null;
      arq = document.getElementById("imgTag-1");
      if (arq.files[0]) {
        console.log(arq.files[0]);
        arqData = arq.files[0];
        formBgBanner.append("0", arqData);
      }
      formRequest();
      break;
    case 2:
      arq = null;
      arq = document.getElementById("imgTag-2");
      if (arq.files[0]) {
        console.log(arq.files[0]);
        arqData = arq.files[0];
        formBgBanner.append("1", arqData);
      }
      formRequest();
      break;
    case 3:
      arq = null;
      arq = document.getElementById("imgTag-2");
      if (arq.files[0]) {
        console.log(arq.files[0]);
        arqData = arq.files[0];
        formBgBanner.append("2", arqData);
      }
      formRequest();
      break;

    default:
      break;
  }
}

async function formRequest() {
  return await $fetch("http://dazl.kinghost.net/api/formBanners.php ", {
    mode: "cors",
    headers: {
      boundary:
        "---------------------------" +
        Math.floor(Math.random() * 16).toString(16),
    },
    method: "POST",
    body: formBgBanner,
  }).then((R) => {
    alert(R);
  });
}
</script>
