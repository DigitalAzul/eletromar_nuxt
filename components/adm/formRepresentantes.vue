<template>
  <div class="flex h-screen w-[calc(100vw-15px)] flex-row">
    <div COLUNA="1" class="h-screen w-[350px] border-r-2 p-6">
      <div
        v-if="representantesfORM.emEdicao == false"
        class="p-4 text-center text-3xl"
      >
        REPRESENTANTES
      </div>
      <div v-else class="animate-pulse bg-yellow-300 p-4 text-center text-3xl">
        REPRESENTANTES / EM EDIÇÃO
      </div>

      <div class="pt-10">
        <form
          @submit.prevent="formRequestRepAdd()"
          action="https://localhost/mec/formRepresentantes.php"
          method="post"
        >
          <div>
            <x-input
              v-model="representantesfORM.estabelecimento"
              label="ESTABELECIMENTO:"
              size="sm"
              name="estabelecimento"
              placeholder="Estabelecimento"
              block
            />
          </div>
          <div class="mt-4">
            <div>
              <x-select
                label="UF"
                v-model="representantesfORM.uf"
                :options="ufsOPT"
                placeholder="Estado (UF)"
                class="w-full"
              />
            </div>
          </div>

          <div>
            <p class="py-4">Contato</p>
            <div
              TRUE="1"
              v-if="representantesfORM.emEdicao == true"
              class="h-fit overflow-clip overflow-y-auto rounded-lg p-2"
            >
              <x-textarea
                class="w-full"
                size="lg"
                v-model="representantesfORM.contato"
              />
              <!-- <Editor
                    v-if="false"
                    :resetEditor="resetEditor"
                    :idContainer="'editorRep'"
                    :existingContent="editorContentRep"
                    @contentChanged="_onChange"
                  /> -->
            </div>
            <div
              FALSE="1"
              v-if="representantesfORM.emEdicao == false"
              class="h-fit overflow-clip overflow-y-auto rounded-lg p-2"
            >
              <x-textarea
                class="w-full"
                size="xl"
                v-model="representantesfORM.contato"
              />
              <!-- <Editor
                    :resetEditor="resetEditor"
                    :idContainer="'editorRep'"
                    :existingContent="editorContentRep"
                    @contentChanged="_onChange"
                  /> -->
            </div>
          </div>

          <div class="flex w-full flex-row justify-between pt-10">
            <x-button color="#ff0000" light @click="excluiRepresentantes()">
              Excluir
            </x-button>
            <x-button @click="resetRepfORM()" color="#000" light
              >Cancelar</x-button
            >
            <x-button color="#000" light type="submit"> Salvar </x-button>
          </div>
        </form>
      </div>
    </div>

    <div
      COLUNA="2A"
      class="h-screen w-[calc(100vw-350px)] overflow-y-auto border-r-2 p-6"
    >
      <div
        class="flex w-full flex-row justify-between space-x-4 rounded-2xl bg-slate-600 p-6 pb-10"
      >
        <div class="">
          <div>
            <x-select
              v-model="queryRep.uf"
              :options="ufsOPT"
              placeholder=" (UF)"
              class="w-full"
            />
          </div>
          <div class="w-full p-10">
            <x-button @click="getRepPorUf" color="primary" class="w-full" light
              >Pesquisar</x-button
            >
          </div>
        </div>
        <div
          @click="getRepresentantes"
          class="flex cursor-pointer flex-col items-center justify-center pb-3 text-white"
        >
          <ph-arrow-counter-clockwise :size="32" />
          <div>Recarregar</div>
        </div>
      </div>
      <div class="flex flex-row flex-wrap gap-2 pt-6">
        <div
          class="w-[350px] cursor-pointer space-y-2 rounded-md border-2 p-4 text-black shadow-xl hover:bg-yellow-200"
          v-for="(rep, index) in representantes"
          :key="index"
          :class="{ 'bg-yellow-400': rep.emEdicao == true }"
          @click="editaRep(rep)"
        >
          <div class="w-full py-2 text-center">PRESENTANTE</div>
          <div
            class="flex flex-row justify-between whitespace-nowrap font-medium text-black"
          >
            <div>UF: {{ rep.uf }}</div>
            <div>Id: {{ rep.id }}</div>
          </div>

          <div class="whitespace-nowrap font-medium">
            Estabeleciemnto:<br />{{ rep.estabelecimento }}
          </div>
          <div class="whitespace-nowrap font-medium">
            Contato:
            <p v-for="(b, index) in rep.contatoArray" :key="index">
              {{ b }}
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
import {
  createUI,
  XButton,
  XAlert,
  XTextarea,
  XSelect,
  XTab,
  XTabGroup,
} from "@indielayer/ui";
import Editor from "~/components/Editor.vue";
components: {
  createUI,
    XButton,
    XAlert,
    XTextarea,
    XSelect,
    PhCamera,
    PhCloudArrowUp,
    PhArrowCounterClockwise,
    XTab,
    XTabGroup,
    Editor;
}
const ufsOPT = ref([]);

let tab = ref();
let formRepImgs = new FormData();
let representantes = ref({
  // estabelecimento: "",
  // contato: "",
  // uf: "",
});
let representantesfORM = ref({
  estabelecimento: "",
  contato: "",
  uf: "",
  emEdicao: false,
});

onMounted(() => {
  getRepresentantes();
  getUfs();
  tab.value = "a";
});

let resetEditor = "";
let editorContentRep = ref({});

function _onChange(data) {
  representantesfORM.value.contato = JSON.stringify(data);
  editorContentRep.value = data;
}

async function excluiRepresentantes() {
  // console.log(representantesfORM.value);
  if (representantesfORM.value.emEdicao == false) {
    return;
  }
  const a = Math.floor(Math.random() * 10);
  const b = Math.floor(Math.random() * 10);
  const s = a + b;

  const c = prompt(
    `Deseja excluir este representante?\nDigite a soma entre ${a} + ${b}`
  );

  if(s != c){
    alert("Resultado da soma não é o esperado!")
    return;
  }


  await $fetch(
    `/api/formRepresentantes.php?i=${representantesfORM.value.id}`,
    {
      method: "DELETE",
    }
  ).then((R1) => {
    alert(R1);
    getRepresentantes()

  });
}

async function getUfs() {
  await $fetch(
    "/api/formUfs.php",

    {
      method: "GET",
    }
  ).then((R1) => {
    ufsOPT.value = JSON.parse(R1);
  });
}

// async function todasUfs() {
// const U =  await $fetch("/api/formUfs.php", {
//   mode: "cors",
//   method: "GET",
// });

//   ufsOPT.value = JSON.parse(U);
// }
function resetRepfORM() {
  representantesfORM.value = {
    estabelecimento: "",
    contato: "",
    uf: "",
    emEdicao: false,
  };
  representantes.value.map((r) => {
    r.emEdicao = false;
  });
  resetEditor = randonico(7);
  editorContentRep.value = {};
  representantesfORM.value.emEdicao = false;
  resetEditor = randonico(7);
}
function editaRep(rep) {
  tab.value = "a";
  representantesfORM.value.emEdicao = false;
  resetRepfORM();
  representantes.value.map((r) => {
    r.emEdicao = false;
  });
  rep.emEdicao = true;

  //_onChange(JSON.parse(rep.contato));
  representantesfORM.value = rep; //Object.assign({}, rep);

  representantesfORM.value.emEdicao = true;
}

let queryRep = ref({
  q: "todos",
  uf: "",
});
function getRepPorUf() {
  queryRep.value.q = "por_uf";
  getRepresentantes();
}
async function getRepresentantes() {
  await $fetch("/api/formRepresentantes.php", {
    mode: "cors",
    method: "GET",
    params: { json: queryRep.value },
  }).then((R2) => {
    representantes.value = [];
    let REP = JSON.parse(R2);
    if (REP.codigo == 0) {
      REP.dados.map((r) => {
        r.contatoArray = r.contato.split("\n");
      });
    } else {
      alert(REP.msg);
    }
    // if (REP.codigo == 0) {
    //   REP.dados.map((r) => {
    //     r.contatoArray = JSON.parse(r.contato);
    //   });
    // } else {
    //   alert(REP.msg);
    // }
    representantes.value = REP.dados;
  });
}

async function formRequestRepAdd() {
  //ADD FORM JSON
  formRepImgs.delete("json");
  formRepImgs.append("json", JSON.stringify(representantesfORM.value));

  const R = await $fetch("/api/formRepresentantes.php", {
    mode: "cors",
    method: "POST",
    body: formRepImgs,
  });
  getRepresentantes();
  resetRepfORM();
  alert(R);
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
