<template>
  <div class="scpace-x-3 flex flex-row">
    <div COLUNA="1" class="h-screen w-[400px] border-r-2 p-6">
      <div class="p-4 text-center text-3xl">TAGS</div>
      <x-tab-group v-model="tab" class="pb-10" grow variant="line">
        <x-tab value="a" label="Cadastro/Edição">
          <div class="w-[400px] pt-10">
            <form @submit.prevent="formRequestTags">
              <div class="flex flex-col space-y-3">
                <div>
                  <x-input
                    class="w-[90%]"
                    v-model="tagsForm.titulo"
                    label="TAG PT:"
                    size="sm"
                    name="nome"
                  />
                </div>
                <div>
                  <x-input
                    class="w-[90%]"
                    v-model="tagsForm.titulo_en"
                    label="TAG EN:"
                    size="sm"
                    name="nome"
                  />
                </div>
                <div>
                  <x-input
                    class="w-[90%]"
                    v-model="tagsForm.titulo_es"
                    label="TAG ES:"
                    size="sm"
                    name="nome"
                  />
                </div>
              </div>

              <div class="flex w-[90%] flex-row justify-between pt-10">
                <x-button color="#000" light type="submit"> Salvar </x-button>
                <x-button color="#000" light @click="excluirTag()">
                  Excluir
                </x-button>
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
              <th scope="col" class="px-6 py-4">Tag PT</th>
              <th scope="col" class="px-6 py-4">Tag EN</th>
              <th scope="col" class="px-6 py-4">Tag ES</th>
              <th scope="col" class="px-6 py-4">Ações</th>
            </tr>
          </thead>
          <tbody>
            <tr
              class="border-b text-black dark:border-neutral-500"
              v-for="(t, index) in tags"
              :key="index"
            >
              <td class="whitespace-nowrap px-6 py-4 font-medium text-black">
                {{ t.id }}
              </td>
              <td class="whitespace-nowrap px-6 py-4 font-medium">
                {{ t.titulo }}
              </td>
              <td class="whitespace-nowrap px-6 py-4 font-medium">
                {{ t.titulo_en }}
              </td>
              <td class="whitespace-nowrap px-6 py-4 font-medium">
                {{ t.titulo_es }}
              </td>
              <td
                @click="editaTag(t)"
                class="cursor-pointer whitespace-nowrap px-6 py-4 font-medium hover:bg-yellow-400 hover:text-white"
              >
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

function editaTag(tag) {
  console.log(tag);
  tagsForm.value = { ...tag };
  tagsForm.value.emEdicao = true;
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
  getTags();
});

let tags = ref();

let tagsForm = ref({
  titulo: "",
  titulo_en: "",
  titulo_es: "",
  emEdicao: false,
});

const queryTagBlog = ref({
  q: "formBlog",
  offset: 0,
  qpag: 10,
});

async function getTags() {
  let R = await $fetch("/api/formGetTags.php", {
    method: "GET",
    params: queryTagBlog.value,
  }).then((R) => {
    let r = JSON.parse(R);
    console.log(r.dados.length);
    if (r.dados.length > 0) {
      tags.value = r.dados;
    } else {
      tags.value = [];
    }
  });
}

async function formRequestTags() {
  let formdDataTags = new FormData();
  formdDataTags.append("json", JSON.stringify(tagsForm.value));
  return await $fetch("/api/formGetTags.php", {
    mode: "cors",
    method: "POST",
    body: formdDataTags,
  }).then((r) => {
    let R = JSON.parse(r);

    getTags();
    resetFormTag();
    alert(R.msg);
  });
}

function resetFormTag() {
  tagsForm.value = {
    titulo: "",
    titulo_en: "",
    titulo_es: "",
    emEdicao: false,
  };
}

async function excluirTag() {
  let formdExcluirTags = new FormData();
  formdExcluirTags.append("json", JSON.stringify(tagsForm.value));
  return await $fetch("/api/formExcluirTags.php", {
    mode: "cors",
    method: "POST",
    body: formdExcluirTags,
  }).then((r) => {
    let R = JSON.parse(r);
    console.log(R);
    if (R.codigo == 0) {
      getTags();
      resetFormTag();
      alert(R.msg);
    }else{
      alert(R.msg);

    }
  });
}
</script>
