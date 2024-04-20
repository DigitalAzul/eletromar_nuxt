<template>
  <div class="flex flex-row">
    <div COLUNA="1" class="h-screen border-r border-slate-300 p-6">
      <div class="p-4 text-center text-3xl">CATALOGOS</div>
      <form
        @submit.prevent="formRequestPdf"
        method="post"
        class="felx felx-col space-y-3"
      >
        <div class="flex h-[calc(100vh-100px)] flex-col justify-between">
          <div class="flex-col space-y-3">
            <div>
              <x-input
                v-model="catalogoForm.titulo"
                label="Título:"
                size="sm"
                name="titulo"
                block
              />
            </div>
            <div>
              <p>PDF</p>
              <input
                accept="application/pdf,application/vnd.ms-excel"
                type="file"
                id="pdfTag-1"
              />
            </div>
            <div>
              <p>IMAGEM CAPA</p>
              <input id="pdfImg-1" accept="image/png" type="file" />
            </div>
          </div>

          <div class="flex flex-row justify-between">
            <x-button color="#000" light type="submit"> Salvar </x-button>
            <x-button color="#000" @click="limpaForm" light>Cancelar</x-button>
          </div>
        </div>
      </form>
    </div>
    <div COLUNA="2" class="pl-4 pt-10">
      <div class="flex w-[1200px] flex-row flex-wrap">
        <div
          v-for="(c, index) in catalogos"
          :key="index"
          class="min-h-[300px] w-[400px] rounded-2xl border-2 bg-black p-3 shadow-xl"
        >
          <a target="_blank" :href="pathCatalogos + c.pdf">
            <div>
              <img
                :src="pathCatalogos + c.imagem"
                width="400"
                height="300"
                object-fill
              />
            </div>
          </a>
          <div>
            <div class="p-4 text-2xl text-white">{{ c.titulo }}</div>
            <div
              class="cursor-pointer text-right text-xl text-red-500"
              @click="formDeletePdf(c.id)"
            >
              Excluir
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { createUI, XButton, XAlert, XTextarea } from "@indielayer/ui";
components: {
  createUI, XButton, XAlert, XTextarea;
}

const pathCatalogos = "\\media\\catalogos\\";
onMounted(() => {
  getCatalogos();
});

async function getCatalogos() {
  let R = await $fetch("/api/formCatalogo.php", {
    method: "GET",
  }).then((R) => {
    if (JSON.parse(R).length > 0) {
      catalogos.value = JSON.parse(R);
    } else {
      catalogos.value = [];
    }
  });
}

function downloadPdf(pdf) {
  $fetch(pathCatalogos + pdf)
    .then((res) => res.blob())
    .then((blob) => {
      var file = window.URL.createObjectURL(blob);
      window.location.assign(file);
    });
}

async function formRequestPdf() {
  apendFilePdf();
  return await $fetch("/api/formCatalogo.php", {
    mode: "cors",
    headers: {
      boundary:
        "---------------------------" +
        Math.floor(Math.random() * 16).toString(16),
    },
    method: "POST",
    body: formPdfImgs,
  }).then(() => {
    getCatalogos();
  });
}

let editor = "";

function limpaForm() {
  editor = randonico(7);
  catalogoForm.value = {
    titulo: "",
    pdf: "",
    imagem: "",
  };
  document.getElementById("pdfTag-1").src = "";
  document.getElementById("pdfTag-1").value = "";
  document.getElementById("pdfImg-1").src = "";
  document.getElementById("pdfImg-1").value = "";
}

async function formDeletePdf(id) {
  const D = confirm("Deseja excluir o catalogo");

  if (!D) return;

  let ID = id;
  return await $fetch("/api/formCatalogo.php", {
    mode: "cors",
    headers: {
      boundary: "---------------------------974767299852498929531610575",
    },
    method: "DELETE",
    params: { d: ID },
  }).then(() => {
    getCatalogos();
  });
}

let catalogoForm = ref({
  titulo: "",
  pdf: "",
  imagem: "",
});
let catalogos = ref([]);

let formPdfImgs = new FormData();
function apendFilePdf() {
  formPdfImgs = new FormData();
  let arq;
  let arqData;

  // IMAGEM BANNER BLOG
  arq = null;
  arq = document.getElementById("pdfTag-1");
  if (arq.files[0]) {
    arqData = arq.files[0];
    formPdfImgs.append("0", arqData);
  }

  arq = null;
  arq = document.getElementById("pdfImg-1");
  if (arq.files[0]) {
    arqData = arq.files[0];
    formPdfImgs.append("1", arqData);
  }

  //ADD FORM JSON
  formPdfImgs.append("json", JSON.stringify(catalogoForm.value));
}

function randonico(length) {
  let result = "";
  const characters =
    "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
  const charactersLength = characters.length;
  let counter = 0;
  while (counter < length) {
    result += characters.charAt(Math.floor(Math.random() * charactersLength));
    counter += 1;
  }
  return result;
}
</script>
