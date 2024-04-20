<template>
  <div class="flex h-screen w-[calc(100vw-15px)] flex-row">
    <div COLUNA="A" class="h-screen w-[500px] overflow-y-auto border-r-2 p-6">
      <div class="flex w-full flex-row">
        <div class="flex w-full flex-col">
          <p class="text-xl">Currículos</p>
          <p class="text-3xl">Setores</p>
          <div class="flex w-full flex-col space-y-4 pt-6">
            <div class="h-[200px] w-full rounded-lg p-4">
              <x-tab-group v-model="tab" class="pb-10" variant="line">
                <x-tab value="a" label="Setores">
                  <div class="mt-4 w-full rounded-md bg-slate-700 p-4">
                    <p class="py-2 text-white">Nome do Setor</p>
                    <x-input
                    
                      class="h-10 w-full bg-transparent"
                      type="text"
                      placeholder="Nome Setor"
                      v-model="formSetor.label"
                    />
                    <div class="pt-2 text-white cursor-pointer"
                    @click="addSetores()"
                    >Salvar</div>
                  </div>

                  <div class="py-6 flex flex-col space-y-4">
                    <div
                      v-for="(s, index) in setoresOPT"
                      @click="getCurriculosId(s.id)"
                      :key="index"
                      class="flex w-full flex-row justify-between rounded-md border border-slate-700 p-4 uppercase hover:cursor-pointer hover:bg-slate-500"
                    >
                      <div>{{ s.label }}</div>
                      <div>{{ s.qtd }}</div>
                    </div>
                  </div>
                </x-tab>
                <x-tab value="b" label=" Excluir setor">
                  <div
                    class="flex w-full flex-col space-y-2 rounded-md bg-slate-700 p-4 mt-4"
                  >
                    <div
                      v-for="(s, index) in setoresOPT"
                      @click="delCurriculosId(s)"
                      :key="index"
                      class="flex w-full flex-row justify-between rounded-md border border-slate-700 bg-white p-2 uppercase hover:cursor-pointer hover:bg-red-600"
                    >
                      <div>{{ s.label }}</div>
                      <div>{{ s.qtd }}</div>
                    </div>
                  </div>
                </x-tab>
              </x-tab-group>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div COLUNA="B" class="w-full">
      <div class="flex w-full flex-row flex-wrap gap-2 pt-6">
        <div class="-mb-3 mt-4 w-full">
          <div
            class="not-prose relative overflow-hidden rounded-xl bg-slate-50 dark:bg-slate-800/25"
          >
            <div
              style="background-position: 10px 10px"
              class="bg-grid-slate-100 dark:bg-grid-slate-700/25 absolute inset-0 [mask-image:linear-gradient(0deg,#fff,rgba(255,255,255,0.6))] dark:[mask-image:linear-gradient(0deg,rgba(255,255,255,0.1),rgba(255,255,255,0.5))]"
            ></div>
            <div class="relative overflow-auto rounded-xl">
              <div class="my-8 overflow-hidden shadow-sm">
                <table class="w-full table-auto border-collapse text-sm">
                  <thead>
                    <tr>
                      <th
                        class="border-b p-4 pb-3 pl-8 pt-0 text-left font-medium text-slate-400 dark:border-slate-600 dark:text-slate-200"
                      >
                        Nome
                      </th>
                      <th
                        class="border-b p-4 pb-3 pt-0 text-left font-medium text-slate-400 dark:border-slate-600 dark:text-slate-200"
                      >
                        Email
                      </th>
                      <th
                        class="border-b p-4 pb-3 pr-8 pt-0 text-left font-medium text-slate-400 dark:border-slate-600 dark:text-slate-200"
                      >
                        Comentário
                      </th>

                      <th
                        class="border-b p-4 pb-3 pr-8 pt-0 text-left font-medium text-slate-400 dark:border-slate-600 dark:text-slate-200"
                      >
                        UF
                      </th>
                      <th
                        class="border-b p-4 pb-3 pr-8 pt-0 text-left font-medium text-slate-400 dark:border-slate-600 dark:text-slate-200"
                      >
                        Cidade
                      </th>
                      <th
                        class="border-b p-4 pb-3 pr-8 pt-0 text-left font-medium text-slate-400 dark:border-slate-600 dark:text-slate-200"
                      >
                        Setor
                      </th>
                      <th
                        class="border-b p-4 pb-3 pr-8 pt-0 text-left font-medium text-slate-400 dark:border-slate-600 dark:text-slate-200"
                      >
                        Currículo
                      </th>
                      <th
                        class="border-b p-4 pb-3 pr-8 pt-0 text-left font-medium text-slate-400 dark:border-slate-600 dark:text-slate-200"
                      >
                        Política
                      </th>
                    </tr>
                  </thead>
                  <tbody class="bg-white dark:bg-slate-800">
                    <tr v-for="(c, index) in curriculos" :key="index">
                      <td
                        class="border-b border-slate-100 p-4 pl-8 text-slate-500 dark:border-slate-700 dark:text-slate-400"
                      >
                        {{ c.nome }}
                      </td>
                      <td
                        class="border-b border-slate-100 p-4 text-slate-500 dark:border-slate-700 dark:text-slate-400"
                      >
                        {{ c.email }}
                      </td>
                      <td
                        class="border-b border-slate-100 p-4 pr-8 text-slate-500 dark:border-slate-700 dark:text-slate-400"
                      >
                        {{ c.comentario }}
                      </td>
                      <td
                        class="border-b border-slate-100 p-4 pr-8 text-slate-500 dark:border-slate-700 dark:text-slate-400"
                      >
                        {{ c.uf }}
                      </td>

                      <td
                        class="border-b border-slate-100 p-4 pr-8 text-slate-500 dark:border-slate-700 dark:text-slate-400"
                      >
                        {{ c.cidade }}
                      </td>
                      <td
                        class="border-b border-slate-100 p-4 pr-8 uppercase text-slate-500 dark:border-slate-700 dark:text-slate-400"
                      >
                        {{ c.label }}
                      </td>
                      <td
                        class="border-b border-slate-100 p-4 pr-8 text-slate-500 dark:border-slate-700 dark:text-slate-400 underline"
                      >
                        <a target="_blank" :href="pathArquivos + c.pdf">
                          {{ c.pdf }}
                        </a>
                      </td>

                      <td
                        class="border-b border-slate-100 p-4 pr-8 text-slate-500 dark:border-slate-700 dark:text-slate-400"
                      >
                        {{ c.politica == 1 ? "SIM" : "NÃO" }}
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <div
              class="pointer-events-none absolute inset-0 rounded-xl border border-black/5 dark:border-white/5"
            ></div>
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
const pathArquivos = "\\media\\arquivos\\";
const tab = ref("a")
let queryContato = ref({
  origem: "FormCurriculo",
  q: "todos",
  setor: "",
});

const formSetor = ref({
  label: "",
});

const setoresOPT = ref([]);
async function getSetores() {
  let R = await $fetch("/api/setores.php", {
    method: "GET",
  }).then((R) => {
    let RS = JSON.parse(R);
    if (RS.codigo == 0) {
      if (RS.dados.length > 0) {
        setoresOPT.value = [];
        setoresOPT.value = RS.dados;
      } else {
        setoresOPT.value = [];
        alert("Sem resultados pra pesquisa !");
      }
    }
  });
}




let formSetorTMP = new FormData();
async function addSetores() {
  formSetorTMP.delete("json");
  formSetorTMP.append("json", JSON.stringify(formSetor.value));

  let R = await $fetch("/api/setores.php", {
    mode: "cors",
    method: "POST",
    body: formSetorTMP,
  }).then((R) => {
    let RS = JSON.parse(R);
    if (RS.codigo == 0) {
      if (RS.dados.length > 0) {
        getSetores();
        alert(RS.msg);
      } else {
        getSetores();
        alert(RS.msg);
      }
    }
  });
}



let curriculos = ref({});

onMounted(() => {
  getCurriculos();
  getSetores();
});

async function getCurriculosId(setor) {
  queryContato.value.setor = setor;
  queryContato.value.q = "setor";
  getCurriculos("pesquisa");
}

async function getCurriculos(origem) {
  if (origem == "inicio") {
    queryContato.value.q = "todos";
  }
  if (origem == "pesquisa") {
    queryContato.value.q = "setor";
  }

  await $fetch("/api/mailForm.php", {
    mode: "cors",
    method: "GET",
    params: { json: queryContato.value },
  }).then((R2) => {
    curriculos.value = [];
    let Curri = JSON.parse(R2);
    if (Curri.codigo == 0) {
      Curri.dados.map((r) => {
        r.comentarioArray = r.comentario.split("\n");
      });
    } else {
      alert(Curri.msg);
    }
    curriculos.value = Curri.dados;
  });
}
async function delCurriculosId(setor) {
  const R = confirm(`Deseja excluir este Setor? ${setor.label}`);

  if (!R) return;

  queryContato.value.setor = setor.id;
  queryContato.value.q = "delete";

  await $fetch("/api/mailForm.php", {
    mode: "cors",
    method: "GET",
    params: { json: queryContato.value },
  }).then((R2) => {
    curriculos.value = [];
    let Curri = JSON.parse(R2);
    if (Curri.codigo == 0) {
      alert(Curri.msg);
      getCurriculos("inicio");
      getSetores();
    } else {
      alert(Curri.msg);
    }
  });
}
delCurriculosId;
</script>
  