<template>
  <div class="flex h-screen w-[calc(100vw-180px)] flex-row">
    <div
      COLUNA="1"
      class="flex h-screen w-[500px] flex-col overflow-auto border-r border-slate-300 p-6"
    >
      <div class="p-4 text-center text-3xl">LINHAS</div>
      <form @submit.prevent="formRequestLinhaAdd()">
        <div>
          <x-input
            v-model="solucaoLinhasFORM.titulo"
            label="titulo:"
            size="sm"
            name="titulo"
            placeholder="Titulo"
            block
          />
        </div>
        <div>
          <x-input
            v-model="solucaoLinhasFORM.link"
            label="Link:"
            size="sm"
            name="titulo"
            placeholder="Link"
            block
          />
        </div>

        <div class="flex w-[80%] flex-row justify-between pt-10">
          <x-button color="#000" light type="submit"> Salvar </x-button>
          <x-button @click="resetLinhaFORM()" color="#000" light
            >Cancelar</x-button
          >
        </div>
      </form>
    </div>
    <div
      COLUNA="2"
      class="flex h-screen w-[500px] flex-col overflow-auto border-r border-slate-300 p-6"
    >
      <div>
        <div
          @click="getLinhas"
          class="flex cursor-pointer flex-col items-center justify-center pb-6"
        >
          <ph-arrow-counter-clockwise :size="32" />
          <div>Recarregar</div>
        </div>
      </div>
      <div class="flex flex-col space-y-3">
        <div
          class="cursor-pointer rounded-xl border border-slate-300 bg-white p-4 shadow-lg hover:bg-yellow-200"
          :class="{ 'bg-yellow-400': linha.emEdicao == true }"
          v-for="(linha, index) in solucaoLinhas"
          :key="index"
          @click="editLinha(linha)"
        >
          <div>
            <span class="font-semibold">Nome</span>
            <p>{{ linha.titulo }}</p>
          </div>
          <div>
            <span class="font-semibold">Link</span>
            <p>{{ linha.link }}</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { PhArrowCounterClockwise } from "phosphor-vue";
import { createUI, XButton, XAlert, XTextarea } from "@indielayer/ui";
components: {
  createUI, XButton, XAlert, XTextarea, PhArrowCounterClockwise;
}

onMounted(() => {
  getLinhas();
});
let solucaoLinhas = ref([]);
let solucaoLinhasFORM = ref({
  titulo: "",
  link: "",
});

function resetLinhaFORM() {
  solucaoLinhasFORM.value = {
    titulo: "",
    link: "",
  };
}

async function getLinhas() {
  let L = await $fetch("/api/formSolucaoLinhas.php", {
    method: "GET",
  }).then((L) => {
    if (JSON.parse(L).length > 0) {
      solucaoLinhas.value = JSON.parse(L);
    } else {
      alert("Não há Linhas cadastrados !");
    }
  });
}

function editLinha(linha) {
  solucaoLinhasFORM.value = Object.assign({}, linha);
  solucaoLinhasFORM.value.emEdicao = true;
}

async function formRequestLinhaAdd() {
  //ADD FORM JSON
  let formLinha = new FormData();
  formLinha.append("json", JSON.stringify(solucaoLinhasFORM.value));

  const L = await $fetch("/api/formSolucaoLinhas.php", {
    mode: "cors",
    method: "POST",
    body: formLinha,
  });
  getLinhas();
  alert(L);
}

function salvarForm() {
  console.log(solucaoLinhas.value);
}
</script>
