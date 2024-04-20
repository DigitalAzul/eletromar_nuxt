<template>
  <div class="mx-auto flex h-screen flex-row overflow-hidden">
    <div
      @click="abrePainel()"
      class="relative flex h-screen w-4 flex-row items-center bg-black"
    >
      <p class="absolute -left-[15px] text-white">
        <svg
          xmlns="https://www.w3.org/2000/svg"
          fill="none"
          viewBox="0 0 24 24"
          stroke-width="1.5"
          stroke="currentColor"
          class="h-10 w-10"
        >
          <path
            stroke-linecap="round"
            stroke-linejoin="round"
            d="M12 6.75a.75.75 0 110-1.5.75.75 0 010 1.5zM12 12.75a.75.75 0 110-1.5.75.75 0 010 1.5zM12 18.75a.75.75 0 110-1.5.75.75 0 010 1.5z"
          />
        </svg>
      </p>
    </div>

    <div>
      <x-drawer v-model="painelEsquerdo" width="500">
        <div class="w-full">
          <div class="h-[50px] w-full bg-black pt-2 text-center text-white">
            MENU ADMINISTRATIVO
          </div>
          <div NAV="" class="w-full space-y-3">
            <div
              class="h-[40px] w-full cursor-pointer border-1 pl-6 pt-2 hover:bg-slate-500 hover:text-white"
              @click="ativarForm('FormBlog')"
            >
              BLOG - Inclui e edita posts para o blog
            </div>
            <div
              class="h-[40px] w-full cursor-pointer border-1 pl-6 pt-2 hover:bg-slate-500 hover:text-white"
              @click="ativarForm('FormCat')"
            >
              Categorias Blog 
            </div>
            <div
              class="h-[40px] w-full cursor-pointer border-1 pl-6 pt-2 hover:bg-slate-500 hover:text-white"
              @click="ativarForm('FormTags')"
            >
              Tags 
            </div>
            <div
              class="h-[40px] w-full cursor-pointer border-1 pl-6 pt-2 hover:bg-slate-500 hover:text-white"
              @click="ativarForm('FormBlogAutor')"
            >
              Blog Autor
            </div>
            <div
              class="h-[40px] w-full cursor-pointer border-1 pl-6 pt-2 hover:bg-slate-500 hover:text-white"
              @click="ativarForm('FormBlogComentarios')"
            >
              Blog Comentarios
            </div>
            <div
              class="h-[40px] w-full cursor-pointer border-1 pl-6 pt-2 hover:bg-slate-500 hover:text-white"
              @click="ativarForm('FormRepresentantes')"
            >
              Representantes
            </div>
            <div
              class="h-[40px] w-full cursor-pointer border-1 pl-6 pt-2 hover:bg-slate-500 hover:text-white"
              @click="ativarForm('FormSolucaoLinhas')"
            >
              Solucões Linhas
            </div>
            <div
              class="h-[40px] w-full cursor-pointer border-1 pl-6 pt-2 hover:bg-slate-500 hover:text-white"
              @click="ativarForm('FormSolucoes')"
            >
              Soluções
            </div>
            <div
              class="h-[40px] w-full cursor-pointer border-1 pl-6 pt-2 hover:bg-slate-500 hover:text-white"
              @click="ativarForm('FormCatalogo')"
            >
              Catalogo
            </div>
            <div
              class="h-[40px] w-full cursor-pointer border-1 pl-6 pt-2 hover:bg-slate-500 hover:text-white"
              @click="ativarForm('FormNewsLetter')"
            >
              News Letter
            </div>
            <div
              class="h-[40px] w-full cursor-pointer border-1 pl-6 pt-2 hover:bg-slate-500 hover:text-white"
              @click="ativarForm('FormEmpresa')"
            >
              Empresa
            </div>
            <div
              class="h-[40px] w-full cursor-pointer border-1 pl-6 pt-2 hover:bg-slate-500 hover:text-white"
              @click="ativarForm('FormGarantia')"
            >
              Politica De Garantia
            </div>
            <div
              class="h-[40px] w-full cursor-pointer border-1 pl-6 pt-2 hover:bg-slate-500 hover:text-white"
              @click="ativarForm('FormQualidade')"
            >
              Politica De Qualidade
            </div>
            <div
              class="h-[40px] w-full cursor-pointer border-1 pl-6 pt-2 hover:bg-slate-500 hover:text-white"
              @click="ativarForm('FormAmbiente')"
            >
              Politica De Meio Ambiente
            </div>
            <div
              class="h-[40px] w-full cursor-pointer border-1 pl-6 pt-2 hover:bg-slate-500 hover:text-white"
              @click="ativarForm('FormFaq')"
            >
              Faq
            </div>
            <div
              class="h-[40px] w-full cursor-pointer border-1 pl-6 pt-2 hover:bg-slate-500 hover:text-white"
              @click="ativarForm('FormPSociais')"
            >
              Politicas Sociais
            </div>
            <div
              class="h-[40px] w-full cursor-pointer border-1 pl-6 pt-2 hover:bg-slate-500 hover:text-white"
              @click="ativarForm('FormContato')"
            >
              Contatos
            </div>
            <div
              class="h-[40px] w-full cursor-pointer border-1 pl-6 pt-2 hover:bg-slate-500 hover:text-white"
              @click="ativarForm('FormCurriculo')"
            >
              Curriculos
            </div>
          </div>
        </div>
      </x-drawer>
    </div>

    <div class="h-screen w-screen">
      <div v-if="formAtivo == 'FormBlog'"><AdmFormBlog /></div>
      <div v-if="formAtivo == 'FormCat'"><AdmFormCategoriasBlog /></div>
      <div v-if="formAtivo == 'FormTags'"><AdmFormTags /></div>
      <div v-if="formAtivo == 'FormBlogImagens'"><AdmFormBlogImagens /></div>
      <div v-if="formAtivo == 'FormBlogAutor'"><AdmFormBlogAutor /></div>
      <div v-if="formAtivo == 'FormBlogComentarios'">
        <AdmFormBlogComentarios />
      </div>

      <div v-if="formAtivo == 'FormRepresentantes'">
        <AdmFormRepresentantes />
      </div>
      <div v-if="formAtivo == 'FormSolucaoLinhas'">
        <AdmFormSolucaoLinhas />
      </div>
      <div v-if="formAtivo == 'FormSolucoes'"><AdmFormSolucoes /></div>
      <div v-if="formAtivo == 'FormCatalogo'"><AdmFormCatalogo /></div>
      <div v-if="formAtivo == 'FormNewsLetter'"><AdmFormNewsLetter /></div>
      <div v-if="formAtivo == 'FormEmpresa'"><AdmFormEmpresa /></div>
      <div v-if="formAtivo == 'FormGarantia'"><AdmFormGarantia /></div>
      <div v-if="formAtivo == 'FormQualidade'"><AdmFormQualidade /></div>
      <div v-if="formAtivo == 'FormAmbiente'"><AdmFormAmbiente /></div>
      <div v-if="formAtivo == 'FormFaq'"><AdmFormFaq /></div>
      <div v-if="formAtivo == 'FormPSociais'"><AdmFormPSociais /></div>
      <div v-if="formAtivo == 'FormContato'"><AdmFormContato/></div>
      <div v-if="formAtivo == 'FormCurriculo'"><AdmFormCurriculo/></div>
    </div>
  </div>
</template>
  
<script setup>
import { XDrawer } from "@indielayer/ui";
components: {
  XDrawer;
}

let formAtivo = ref("");
const painelEsquerdo = ref(null);
function ativarForm(form) {
  painelEsquerdo.value = false;
  formAtivo.value = form;
}

onMounted(() => {});

function abrePainel() {
  painelEsquerdo.value = !painelEsquerdo.value;
}
</script>
  
    <style>
/* ===== Scrollbar CSS ===== */
/* Firefox */
* {
  scrollbar-width: auto;
  scrollbar-color: #2b7347 #ffffff;
}

/* Chrome, Edge, and Safari */
*::-webkit-scrollbar {
  width: 10px;
}

*::-webkit-scrollbar-track {
  background: #ffffff;
}

*::-webkit-scrollbar-thumb {
  background-color: #2b7347;
  border-radius: 10px;
  border: 2px solid #ffffff;
}
textarea {
  background: #c1c1c1;
}

input {
  background: #c1c1c1;
}
label {
  color: white;
  display: block;
}
</style>