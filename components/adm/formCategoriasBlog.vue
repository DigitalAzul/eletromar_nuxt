<template>
    <div class="scpace-x-3 flex flex-row">
      <div COLUNA="1" class="h-screen w-[400px] border-r-2 p-6">
        <div class="p-4 text-center text-3xl">CATEGORIA BLOG</div>
        <x-tab-group v-model="tab" class="pb-10" grow variant="line">
          <x-tab value="a" label="Cadastro/Edição">
            <div class="w-[400px] pt-10">
              <form @submit.prevent="formRequestCat">
                <div class="flex flex-col space-y-3">
                    <div>
                  <x-input
                    class="w-[90%]"
                    v-model="catForm.titulo"
                    label="CATEGORIA PT:"
                    size="sm"
                    name="nome"
                    
                  />
                </div>
                <div>
                  <x-input
                    class="w-[90%]"
                    v-model="catForm.titulo_en"
                    label="CATEGORIA EN:"
                    size="sm"
                    name="nome"
                    
                  />
                </div>
                <div>
                  <x-input
                    class="w-[90%]"
                    v-model="catForm.titulo_es"
                    label="CATEGORIA ES:"
                    size="sm"
                    name="nome"
                    
                  />
                </div>
                </div>

                <div class="flex w-[90%] flex-row justify-between pt-10">
                  <x-button color="#000" light type="submit"> Salvar </x-button>
                  <x-button @click="resetFormTag()" color="#000" light
                    >Cancelar</x-button
                  >
                </div>
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
        <div class="w-[99%] overflow-hidden border-2">
          <table class="w-[99%] text-left text-sm font-light">
            <thead class="border-b font-medium dark:border-neutral-500">
              <tr>
                <th scope="col" class="px-6 py-4">#ID</th>
                <th scope="col" class="px-6 py-4">Categoria PT</th>
                <th scope="col" class="px-6 py-4">Categoria EN</th>
                <th scope="col" class="px-6 py-4">Categoria ES</th>
                <th scope="col" class="px-6 py-4">Ações</th>

              </tr>
            </thead>
            <tbody>
              <tr
                class="border-b text-black dark:border-neutral-500"
                v-for="(c, index) in categorias"
                :key="index"
              >
                <td class="whitespace-nowrap px-6 py-4 font-medium text-black">
                  {{ c.id }}
                </td>
                <td class="whitespace-nowrap px-6 py-4 font-medium">
                  {{ c.titulo }}
                </td>
                <td class="whitespace-nowrap px-6 py-4 font-medium">
                  {{ c.titulo_en }}
                </td>
                <td class="whitespace-nowrap px-6 py-4 font-medium">
                  {{ c.titulo_es }}
                </td>
                <td 
                @click="editaCategoria(c)"
                class="whitespace-nowrap px-6 py-4 font-medium cursor-pointer hover:bg-yellow-400 hover:text-white">
                  Editar
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </template>
  
  <script setup>
  import { computed } from "vue";
  import {
    createUI,
    XButton,
    XAlert,
    XTextarea,
    XTab,
    XTabGroup,
    XTable,
  } from "@indielayer/ui";
  components: {
    createUI, XButton, XAlert, XTextarea, XTab, XTabGroup, XTable;
  }
  
  const tab = ref("a");
  
  const tagsFormQuery = ref({
    nome: "",
    email: "",
    data: "",
  });
  let queryNews = ref({
    q: "",
    offset: 0,
    qpag: 30,
    email: "",
    dataInicio: "",
    dataFim: "",
  });
  


  function editaCategoria(tag) {
    console.log(tag);
    catForm.value = {...tag};
    catForm.value.emEdicao = true;
  }
  
  function resetFormNewsQuery() {
    queryNews.value = {
      q: "",
      offset: 0,
      qpag: 30,
      email: "",
      dataInicio: "",
      dataFim: "",
    };
  }
  
  onMounted(() => {
    tab.value = "a";
    getCategorias();
  });
  
  let categorias = ref();
  
  let catForm = ref({
    titulo: "",
    titulo_en: "",
    titulo_es: "",
    emEdicao: false
  });
  
  const queryCategoriaBlog = ref({
    q: "formBlog",
    offset: 0,
    qpag: 10,
  });

  async function getCategorias() {
    let R = await $fetch("/api/formCategoriasGet.php", {
      method: "GET",
      params: queryCategoriaBlog.value
    }).then((R) => {
        let r = JSON.parse(R);
      if (r.dados.length > 0) {
        categorias.value = r.dados;
      } else {
        categorias.value = [];  
      }
    });
  }
  
  async function formRequestCat() {
    let formdDataTags = new FormData();
    formdDataTags.append("json", JSON.stringify(catForm.value));
    return await $fetch("/api/formCategoriasGet.php", {
      mode: "cors",
      method: "POST",
      body: formdDataTags,
    }).then((r) => {
      let R = JSON.parse(r);
      getCategorias();
      resetFormTag();
      alert(R.msg);
    });
  }
  
  function resetFormTag() {
    catForm.value = {
      titulo: "",
    titulo_en: "",
    titulo_es: "",
    emEdicao: false
    };
  }
  </script>
  