<template>
  <div class="flex h-screen w-[calc(100vw-180px)] flex-row">
    <div COLUNA="1" class="flex h-screen w-[500px] flex-col overflow-auto p-6">
      <div class="p-4 text-center text-3xl">AUTORES</div>
      <div class="flex w-[100px] flex-col items-center justify-center p-2">
        <div class="pre-visao">
          <img :src="previsao.src" />
        </div>
        <div
          :class="avatarEdit ? 'justify-between' : 'justify-center'"
          class="flex flex-row space-x-3"
        >
          <div
            @click="file.click()"
            class="cursor-pointer text-black"
            title="Trocar imagem"
          >
            <ph-camera :size="22" />
          </div>
          <div
            v-if="false"
            @click="uploadImage()"
            class="cursor-pointer text-green-600"
            title="Salvar imagem"
          >
            <ph-cloud-arrow-up :size="22" />
          </div>
          <div
            v-if="false"
            @click="resetAvatar()"
            class="cursor-pointer text-black"
            title="Restaurar original"
          >
            <ph-arrow-counter-clockwise :size="22" />
          </div>
          <button class="button hidden">
            <input
              class=""
              type="file"
              ref="file"
              @change="uploadImage($event)"
              accept="image/jpeg"
            />
          </button>
        </div>
      </div>
      <form
        id="formAutorID"
        @submit.prevent="CRUD()"
        class="flex flex-col space-y-3 text-white"
      >
        <div>
          <x-input
            v-model="blogAutor.nome"
            label="nome:"
            size="sm"
            name="nome"
            placeholder="Placeholder"
            block
          />
        </div>
        <div>
          <x-textarea
            v-model="blogAutor.bio"
            label="bio:"
            name="bio"
            :adjust-to-text="false"
            rows="4"
            style="display: block !important"
          />
        </div>
        <div>
          <x-textarea
            v-model="blogAutor.bio_en"
            label="bio EN:"
            name="bioEN"
            :adjust-to-text="false"
            rows="4"
            style="display: block !important"
          />
        </div>
        <div>
          <x-textarea
            v-model="blogAutor.bio_es"
            label="bio ES:"
            name="bioES"
            :adjust-to-text="false"
            rows="4"
            style="display: block !important"
          />
        </div>
        <div>
          <x-input
            v-model="blogAutor.social_instagram"
            label="Rede social Instagram:"
            size="sm"
            name="socialInstagram"
            placeholder="Placeholder"
            block
          />
        </div>
        <div>
          <x-input
            v-model="blogAutor.social_facebook"
            label="Rede social Facebook:"
            size="sm"
            name="socialFacebook"
            placeholder="Placeholder"
            block
          />
        </div>
        <div>
          <x-input
            v-model="blogAutor.social_linkedin"
            label="Rede social Linkedin:"
            size="sm"
            name="socialLinkedin"
            placeholder="Placeholder"
            block
          />
        </div>
        <div class="flex w-[90%] flex-row justify-between pt-10">
          <x-button color="#000" light type="submit"> Salvar </x-button>
          <x-button @click="resetformblogAutor()" color="#000" light
            >Cancelar</x-button
          >
        </div>
      </form>
    </div>
    <div
      v-if="image.src.length"
      COLUNA="2"
      class="h-screen w-[500px] bg-green-900 p-6"
    >
      <Cropper
        ref="cropper"
        class="cropper w-96"
        @change="cropImage"
        :src="image.src"
        :stencil-component="CircleStencil"
        :auto-zoom="false"
        :stencil-props="{
          aspectRatio: 10 / 10,
        }"
        :debounce="false"
      />
      <div class="button-wrapper hidden">
        <input
          type="file"
          ref="file"
          @change="uploadImage($event)"
          accept="image/*"
        />
      </div>
    </div>
    <div
      COLUNA="3"
      class="flex h-screen w-[500px] flex-col space-y-2 overflow-y-auto bg-green-100 p-4"
    >
      <div>
        <div
          @click="getAuores"
          class="flex cursor-pointer flex-col items-center justify-center"
        >
          <ph-arrow-counter-clockwise :size="32" />
          <div>Recarregar</div>
        </div>
      </div>
      <div
        class="cursor-pointer rounded-xl border bg-white p-4 hover:bg-yellow-200"
        :class="{ 'bg-yellow-400': autor.emEdicao == true }"
        v-for="(autor, index) in autores"
        :key="index"
        @click="editAutor(autor)"
      >
        <div class="flex flex-row">
          <div class="pre-visao">
            <img :src="pathBlogAutores + autor.imagem" />
          </div>
          <div class="flex flex-col pl-3">
            <div>Nome: {{ autor.nome }}</div>
            <div>FaceBook: {{ autor.social_facebook }}</div>
            <div>Instagram: {{ autor.social_instagram }}</div>
            <div>Instagram: {{ autor.social_linkedin }}</div>
          </div>
        </div>
        <div class="flex flex-col space-y-2">
          <div>
            <span class="font-semibold">BIO</span>
            <p>
              {{ autor.bio }}
            </p>
          </div>
          <div>
            <span class="font-semibold">BIO EN</span>
            <p>
              {{ autor.bio_en }}
            </p>
          </div>
          <div>
            <span class="font-semibold">BIO ES</span>
            <p>
              {{ autor.bio_es }}
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import {
  PhCamera,
  PhCloudArrowUp,
  PhArrowCounterClockwise,
} from "phosphor-vue";
import { ref, onMounted, reactive } from "vue";
import { CircleStencil, Cropper, Preview } from "vue-advanced-cropper";
import "vue-advanced-cropper/dist/style.css";

import { createUI, XButton, XAlert, XTextarea } from "@indielayer/ui";

components: {
  createUI,
    XButton,
    XAlert,
    XTextarea,
    Cropper,
    CircleStencil,
    Preview,
    PhCamera,
    PhCloudArrowUp,
    PhArrowCounterClockwise;
}

let autores = ref([]);
const pathBlogAutores = "\\media\\blog\\";

onMounted(() => {
  getAuores();
});

async function getAuores() {
  let AUT = await $fetch("/api/formBlogAutor.php?todos", {
    method: "GET",
  }).then((R) => {
    let RS = JSON.parse(R);
    if (RS.codigo == 0) {
      if (RS.dados.length > 0) {
        autores.value = RS.dados;
      } else {
        autores.value = [];
        alert("Sem resultados pra pesquisa !");
      }
    }
  });
}

let editarAutor = ref(null);
function editAutor(autor) {
  blogAutor.value = Object.assign({}, autor);
  autor.emEdicao = true;
  blogAutor.value.emEdicao = true;
  previsao.src = "/media/blog/" + autor.imagem;
  image.src = "/media/blog/" + autor.imagem;
  image.type = "image/png";
}
function resetformblogAutor() {
  blogAutor.value = {
    emEdicao: false,
    nome: "",
    bio: "",
    bio_en: "",
    bio_es: "",
    imagem: "",
    social_instagram: "",
    social_facebook: "",
    social_linkedin: "",
  };
  previsao.src = null;
  image.src = "";
  getAuores();
}

let formAutorImgs = new FormData();
let blogAutor = ref({
  emEdicao: false,
  nome: "",
  bio: "",
  bio_en: "",
  bio_es: "",
  imagem: "",
  social_instagram: "",
  social_facebook: "",
  social_linkedin: "",
});

// CROP
const avatarEdit = ref(true);
let previsao = reactive({
  src: "",
  type: "image/jpg",
});
let image = reactive({
  src: "",
  type: "image/jpg",
});
const cropper = ref();

const file = ref();

const cropImage = () => {
  if (cropper.value) {
    const { canvas } = cropper.value.getResult();
    previsao.src = null;
    previsao.src = canvas.toDataURL();

    canvas.toBlob((blob) => {
      formAutorImgs.delete("0");
      formAutorImgs.append("0", blob);
    });

    // const newTab = window.open();
    // if (newTab && canvas) {
    //   newTab.document.body.innerHTML = `<img src="${canvas.toDataURL(
    //     image.type
    //   )}"></img>`;
    // }
  }
};
const uploadImage = (event) => {
  /// Reference to the DOM input element
  const { files } = event.target;
  // Ensure that you have a file before attempting to read it
  if (files && files[0]) {
    // 1. Revoke the object URL, to allow the garbage collector to destroy the uploaded before file
    if (image.src) {
      URL.revokeObjectURL(image.src);
    }
    // 2. Create the blob link to the file to optimize performance:
    const blob = URL.createObjectURL(files[0]);

    // 3. Update the image. The type will be derived from the extension and it can lead to an incorrect result:
    image.src = blob;
    image.type = files[0].type;
  }
};
onUnmounted(() => {
  if (image.src) {
    URL.revokeObjectURL(image.src);
  }
});
// CROP

// function apendFile(n) {
//   let arq;
//   let arqData;
//   formAutorImgs = new FormData();

//   // IMAGEM BANNER BLOG
//   arq = null;
//   arq = document.getElementById("banner-1");
//   if (arq.files[0]) {
//     arqData = arq.files[0];
//     formAutorImgs.append("0", arqData);
//   }
// }

function CRUD() {
  formRequestAutorAdd();
}
async function formRequestAutorAdd() {
  //ADD FORM JSON
  formAutorImgs.delete("json");
  formAutorImgs.append("json", JSON.stringify(blogAutor.value));

  const R = await $fetch("/api/formBlogAutor.php", {
    mode: "cors",
    headers: {
      boundary: "---------------------------974767299852498929531610575",
    },
    method: "POST",
    body: formAutorImgs,
  });
  alert(R);
  getAuores();
  resetformblogAutor();
}

function salvarForm() {
  console.log(blogAutor.value);
}
</script>

<style scoped>
.pre-visao {
  position: relative;
  width: 100px;
  height: 100px;
  border-radius: 100%;
  background: #ccc;
  overflow: hidden;
}
.pre-visao img {
  object-fit: center;
  background-size: fit;
  position: absolute;
  min-width: 1000%;
  min-height: 1000%;
  left: 50%;
  top: 50%;
  transform: translateX(-50%) translateY(-50%) scale(0.1);
}
</style>