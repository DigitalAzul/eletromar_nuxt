<template>
  <div class="flex h-screen w-[calc(100vw-180px)] flex-row">
    <div COLUNA="1" class="h-screen w-[500px] border-r-2 p-6">
      <div
        v-if="representantesfORM.emEdicao == false"
        class="p-4 text-center text-3xl"
      >
        REPRESENTANTES
      </div>
      <div v-else class="animate-pulse bg-yellow-300 p-4 text-center text-3xl">
        REPRESENTANTES / EM EDIÇÃO
      </div>

      <x-tab-group v-model="tab" class="pb-10" variant="line" grow>
        <x-tab value="a" label="Cadastro">
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
                  class="h-[350px] overflow-clip overflow-y-auto rounded-lg border-2 border-slate-500 p-4"
                >
                  <Editor
                    :resetEditor="resetEditor"
                    :idContainer="'editorRep'"
                    :existingContent="editorContentRep"
                    @contentChanged="_onChange"
                  />
                </div>
                <div
                  FALSE="1"
                  v-if="representantesfORM.emEdicao == false"
                  class="h-[350px] overflow-clip overflow-y-auto rounded-lg border-2 border-slate-500 p-4"
                >
                  <Editor
                    :resetEditor="resetEditor"
                    :idContainer="'editorRep'"
                    :existingContent="editorContentRep"
                    @contentChanged="_onChange"
                  />
                </div>
              </div>

              <div class="flex w-[90%] flex-row justify-between pt-10">
                <x-button color="#000" light type="submit"> Salvar </x-button>
                <x-button @click="resetRepfORM()" color="#000" light
                  >Cancelar</x-button
                >
              </div>

              <!-- <div class="flex flex-row justify-between p-10 text-white">
          <input type="submit" value="Salvar" class="cursor-pointer" />
          <p class="cursor-pointer" @click="resetRepfORM">Cancelar</p>
        </div> -->
            </form>
          </div>
        </x-tab>
        <x-tab value="b" label="Listagem">
          <div class="mt-4 p-10">
            <div>
              <x-select
                v-model="queryRep.uf"
                label="Listar por UF"
                :options="ufsOPT"
                placeholder=" (UF)"
                class="w-full"
              />
            </div>
            <div class="w-full p-10">
              <x-button
                @click="getRepPorUf"
                color="primary"
                class="w-full"
                light
                >Pesquisar</x-button
              >
            </div>
          </div>
        </x-tab>
      </x-tab-group>
    </div>

    <div v-if="tab == 'a'" COLUNA="2A" class="w-[500px] border-r-2">
      <div class="border-b text-black dark:border-neutral-500">
        <div
          class="whitespace-nowrap border-slate-500 border-b-2 px-6 py-4 font-medium text-black"
        >
          <p class="text-xs">ID:</p>
          <div>{{ representantesfORM.id }}</div>
        </div>
        <x-divider class="my-2" />
        <div
          class="whitespace-nowrap border-slate-500 border-b-2 px-6 py-4 font-medium"
        >
          <p class="text-xs">ESTADO:</p>
          {{ representantesfORM.uf }}
        </div>
        <div
          class="whitespace-nowrap border-slate-500 border-b-2 px-6 py-4 font-medium"
        >
          <p class="text-xs">ESTABELECIMENTO:</p>
          {{ representantesfORM.estabelecimento }}
        </div>
        <div
          class="whitespace-nowrap border-slate-500 border-b-2 px-6 py-4 font-medium"
        >
          <p class="text-xs">CONTATO</p>
          <p v-for="(b, index) in editorContentRep.blocks" :key="index">
            {{ b.data.text }}
          </p>
        </div>
      </div>
    </div>
    <div
      v-if="tab == 'b'"
      coluna="2B"
      class="h-screen w-[1000px] overflow-auto px-6"
    >
      <div
        @click="getRepresentantes"
        class="flex cursor-pointer flex-col items-center justify-center pb-3"
      >
        <ph-arrow-counter-clockwise :size="32" />
        <div>Recarregar</div>
      </div>

      <!-- TABELA -->
      <div class="w-[900px] overflow-hidden border-2">
        <table class="w-[1000px] text-left text-sm font-light">
          <thead class="border-b font-medium dark:border-neutral-500">
            <tr>
              <th scope="col" class="px-6 py-4">#ID</th>
              <th scope="col" class="px-6 py-4">UF</th>
              <th scope="col" class="px-6 py-4">Estabelecimento</th>
              <th scope="col" class="px-6 py-4">Contato</th>
            </tr>
          </thead>
          <tbody v-if="Object.keys(representantes).length > 0">
            <tr
              class="border-b text-black dark:border-neutral-500"
              v-for="(rep, index) in representantes"
              :key="index"
              :class="{ 'bg-yellow-400': rep.emEdicao == true }"
              @click="editaRep(rep)"
            >
              <td class="whitespace-nowrap px-6 py-4 font-medium text-black">
                {{ rep.id }}
              </td>
              <td class="whitespace-nowrap px-6 py-4 font-medium">
                {{ rep.uf }}
              </td>
              <td class="whitespace-nowrap px-6 py-4 font-medium">
                {{ rep.estabelecimento }}
              </td>
              <td class="whitespace-nowrap px-6 py-4 font-medium">
                <p v-for="(b, index) in rep.contatoArray.blocks" :key="index">
                  {{ b.data.text }}
                </p>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      <!-- TABELA -->
      <!-- <div class="space-y-2">
        <div
          v-for="(rep, index) in representantes"
          :key="index"
          class="cursor-pointer space-y-2 rounded-xl border bg-white p-4 hover:bg-yellow-200"
          :class="{ 'bg-yellow-400': rep.emEdicao == true }"
          @click="editaRep(rep)"
        >
          <div>
            <span class="text-base font-semibold">Nome:</span> {{ rep.nome }}
          </div>
          <div>
            <span class="text-base font-semibold">Contato:</span>
            {{ rep.contato }}
          </div>
          <div>
            <div>
              <x-select
                disabled
                v-model="rep.uf_id"
                label="UF"
                :options="ufsOPT"
                placeholder="Estado (UF)"
                class="w-full"
              />
            </div>
          </div>
          <div>
            <span class="text-base font-semibold">Estabeleciemnto:</span>
            <br />{{ rep.estabelecimento }}
          </div>
        </div>
      </div> -->
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

function salvarForm() {
  console.log(representantes.value);
}

async function getUfs() {
  await $fetch(
    "/api/formUfs.php",

    {
      method: "GET",
    }
  ).then((R1) => {
    console.log(JSON.parse(R1));
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

  _onChange(JSON.parse(rep.contato));
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
        r.contatoArray = JSON.parse(r.contato);
      });
    } else {
      alert(REP.msg);
    }
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
