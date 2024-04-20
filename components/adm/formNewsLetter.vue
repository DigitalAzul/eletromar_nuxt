<template>
  <div class="scpace-x-3 flex flex-row">
    <div COLUNA="1" class="h-screen w-[400px] border-r-2 p-6">
      <div class="p-4 text-center text-3xl">NEWS LETTERS</div>
      <x-tab-group v-model="tab" class="pb-10" grow variant="line">
        <x-tab value="a" label="Cadastro">
          <div class="w-[400px] pt-10">
            <form @submit.prevent="formRequestNews">
              <div>
                <x-input
                  class="w-[90%]"
                  v-model="newsLettersForm.nome"
                  label="Nome:"
                  size="sm"
                  name="nome"
                  placeholder="Placeholder"
                />
              </div>
              <div>
                <x-input
                  class="w-[90%]"
                  v-model="newsLettersForm.email"
                  label="email:"
                  size="sm"
                  name="email"
                  placeholder="Placeholder"
                  type="email"
                />
              </div>
              <div class="flex w-[90%] flex-row justify-between pt-10">
                <x-button color="#000" light type="submit"> Salvar </x-button>
                <x-button @click="resetFormNews()" color="#000" light
                  >Cancelar</x-button
                >
              </div>
            </form>
          </div>
        </x-tab>
        <x-tab value="b" label="Pesquisas">
          <div class="w-[400px]">
            <div class="w-[400px] pt-10">
              <form>
                <div class="flex flex-col space-y-3">
                  <div>
                    <x-input
                      class="w-[90%]"
                      v-model="queryNews.q"
                      label="Por Nome:"
                      size="sm"
                      name="nome"
                      placeholder="Nome"
                    />
                  </div>

                  <div>
                    <x-input
                      class="w-[90%]"
                      v-model="queryNews.dataInicio"
                      label="Data inicial"
                      type="date"
                      name="data"
                      size="sm"
                    />
                  </div>
                  <div>
                    <x-input
                      class="w-[90%]"
                      v-model="queryNews.dataFim"
                      label="Data final"
                      type="date"
                      name="data"
                      size="sm"
                    />
                  </div>

                  <div class="flex w-[90%] flex-row justify-between pt-10">
                    <x-button color="#000" light @click="getNewsQ()">
                      Pesquisar</x-button
                    >
                    <x-button @click="resetFormNewsQuery()" color="#000" light
                      >Cancelar</x-button
                    >
                  </div>
                </div>
              </form>
            </div>
          </div>
        </x-tab>
      </x-tab-group>
    </div>
    <!-- TAB A COLUNA 2A -->
    <div
      COLUNA="2A"
      class="h-screen w-[1000px] overflow-y-auto overflow-x-hidden p-10"
    >
      <div class="w-[1000px] overflow-hidden border-2">
        <table class="w-[1000px] text-left text-sm font-light">
          <thead class="border-b font-medium dark:border-neutral-500">
            <tr>
              <th scope="col" class="px-6 py-4">#ID</th>
              <th scope="col" class="px-6 py-4">Nome</th>
              <th scope="col" class="px-6 py-4">Email</th>
              <th scope="col" class="px-6 py-4">Data</th>
            </tr>
          </thead>
          <tbody>
            <tr
              class="border-b text-black dark:border-neutral-500"
              v-for="(n, index) in newsLetters"
              :key="index"
            >
              <td class="whitespace-nowrap px-6 py-4 font-medium text-black">
                {{ n.id }}
              </td>
              <td class="whitespace-nowrap px-6 py-4 font-medium">
                {{ n.nome }}
              </td>
              <td class="whitespace-nowrap px-6 py-4 font-medium">
                {{ n.email }}
              </td>
              <td class="whitespace-nowrap px-6 py-4 font-medium">
                {{ n.criado_em }}
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

const newsLettersFormQuery = ref({
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

async function getNewsQ() {
  let Qlen = queryNews.value.q.length;

  if (queryNews.value.dataInicio != "" && queryNews.value.dataFim != "") {
    let R = await $fetch(
      "/api/formNewsLetter.php",

      {
        method: "GET",
        params: queryNews.value,
      }
    ).then((R) => {
      if (JSON.parse(R).length > 0) {
        newsLetters.value = JSON.parse(R);
      } else {
        newsLetters.value = [];
        alert("Sem resultados pra pesquisa !");
      }
    });
  }
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
  getNews();
});

let newsLetters = ref({
  nome: "",
  email: "",
});

let newsLettersForm = ref({
  nome: "",
  email: "",
});

async function getNews() {
  let R = await $fetch("/api/formNewsLetter.php", {
    method: "GET",
  }).then((R) => {
    if (JSON.parse(R).length > 0) {
      newsLetters.value = JSON.parse(R);
    } else {
      newsLetters.value = [];
    }
  });
}

async function formRequestNews() {
  let formdDataNews = new FormData();
  formdDataNews.append("json", JSON.stringify(newsLettersForm.value));
  return await $fetch("/api/formNewsLetter.php", {
    mode: "cors",
    method: "POST",
    body: formdDataNews,
  }).then(() => {
    //getNews();
  });
}

function resetFormNews() {
  newsLettersForm.value = {
    nome: "",
    email: "",
  };
}
</script>
