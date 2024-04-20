<template>
  <div class="flex h-screen w-[calc(100vw-15px)] flex-row">
    <div COLUNA="A" class="h-screen w-[500px] overflow-y-auto border-r-2 p-6">
      <div class="flex w-full flex-row">
        <div class="flex w-full flex-col">
          <p class="text-xl">Contatos</p>
          <p class="text-3xl">Site</p>
          <div class="flex w-full flex-col space-y-4 pt-6">
            <div class="h-[200px] w-full rounded-lg p-4">
              <x-tab-group v-model="tab" class="pb-10" variant="line">
                <x-tab value="a" label="Por UFs">
                  <div class="flex flex-col space-y-4 py-6">
                    <div
                      v-for="(c, index) in contatosUF"
                      @click="getContPorUf(c.uf)"
                      :key="index"
                      class="flex w-full flex-row justify-between rounded-md border border-slate-700 p-4 uppercase hover:cursor-pointer hover:bg-slate-500"
                    >
                      <div>{{ c.uf }}</div>
                      <div>{{ c.qtd }}</div>
                    </div>
                  </div>
                </x-tab>
              </x-tab-group>
            </div>
          </div>
        </div>
      </div>
      <!-- <div
        class="flex w-full flex-row justify-between space-x-4 rounded-2xl bg-slate-600 p-6 pb-10"
      >
        <div class="">
          <div>
            <x-input
              v-model="queryContato.empresa"
              label="Nome da empresa:"
              size="sm"
              name="empresa"
              placeholder="Nome da empresa"
              block
            />
          </div>
          <div>
            <x-input
              v-model="queryContato.cnpj"
              label="CNPJ: "
              size="sm"
              name="cnpj"
              placeholder="Cnpj"
              block
            />
          </div>
          <div class="w-full p-10">
            <x-button
              @click="getContPorNome"
              color="primary"
              class="w-full"
              light
              >Pesquisar</x-button
            >
          </div>
        </div>
        <div
          @click="getContatos"
          class="flex cursor-pointer flex-col items-center justify-center pb-3 text-white"
        >
          <ph-arrow-counter-clockwise :size="32" />
          <div>Recarregar</div>
        </div>
      </div> -->
    </div>
    <div COLUNA="B" class="flex w-full flex-row flex-wrap gap-2 pt-6">
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
                      Mensagem
                    </th>
                    <th
                      class="border-b p-4 pb-3 pt-0 text-left font-medium text-slate-400 dark:border-slate-600 dark:text-slate-200"
                    >
                      Empresa
                    </th>
                    <th
                      class="border-b p-4 pb-3 pr-8 pt-0 text-left font-medium text-slate-400 dark:border-slate-600 dark:text-slate-200"
                    >
                      CNPJ
                    </th>
                    <th
                      class="border-b p-4 pb-3 pr-8 pt-0 text-left font-medium text-slate-400 dark:border-slate-600 dark:text-slate-200"
                    >
                      Nome
                    </th>

                    <th
                      class="border-b p-4 pb-3 pr-8 pt-0 text-left font-medium text-slate-400 dark:border-slate-600 dark:text-slate-200"
                    >
                      Menssagem
                    </th>
                    <th
                      class="border-b p-4 pb-3 pr-8 pt-0 text-left font-medium text-slate-400 dark:border-slate-600 dark:text-slate-200"
                    >
                      Email
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
                      Política
                    </th>
                  </tr>
                </thead>
                <tbody class="bg-white dark:bg-slate-800">
                  <tr v-for="(cont, index) in contatos" :key="index">
                    <td
                      class="border-b border-slate-100 p-4 pl-8 text-slate-500 dark:border-slate-700 dark:text-slate-400"
                    >
                      {{ cont.mensagem }}
                    </td>
                    <td
                      class="border-b border-slate-100 p-4 text-slate-500 dark:border-slate-700 dark:text-slate-400"
                    >
                      {{ cont.empresa }}
                    </td>
                    <td
                      class="border-b border-slate-100 p-4 pr-8 text-slate-500 dark:border-slate-700 dark:text-slate-400"
                    >
                      {{ cont.CNPJ }}
                    </td>
                    <td
                      class="border-b border-slate-100 p-4 pr-8 text-slate-500 dark:border-slate-700 dark:text-slate-400"
                    >
                      {{ cont.nome }}
                    </td>

                    <td
                      class="border-b border-slate-100 p-4 pr-8 text-slate-500 dark:border-slate-700 dark:text-slate-400"
                    >
                      {{ cont.mensagem }}
                    </td>
                    <td
                      class="border-b border-slate-100 p-4 pr-8 text-slate-500 dark:border-slate-700 dark:text-slate-400"
                    >
                      {{ cont.email }}
                    </td>
                    <td
                      class="border-b border-slate-100 p-4 pr-8 text-slate-500 dark:border-slate-700 dark:text-slate-400"
                    >
                      {{ cont.uf }}
                    </td>
                    <td
                      class="border-b border-slate-100 p-4 pr-8 text-slate-500 dark:border-slate-700 dark:text-slate-400"
                    >
                      {{ cont.cidade }}
                    </td>
                    <td
                      class="border-b border-slate-100 p-4 pr-8 text-slate-500 dark:border-slate-700 dark:text-slate-400"
                    >
                      {{ cont.politica == 1 ? "SIM" : "NÃO" }}
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
      <!-- <div
          class="w-[350px] cursor-pointer space-y-2 rounded-md border-2 p-4 text-black shadow-xl hover:bg-yellow-200"
          v-for="(cont, index) in contatos"
          :key="index"
          >
          <div class="w-full py-2 text-center">Contatos</div>
          <div
            class="flex flex-col justify-between whitespace-nowrap font-medium text-black"
          >
          <div class="flex flex-col">
            <div class="text-sm">Empresa:</div>
            <div>{{ cont.empresa }}</div>
          </div>
          <div class="flex flex-col">
            <div class="text-sm">Nome:</div>
            <div>{{ cont.nome }}</div>
          </div>
          <div class="flex flex-col">
            <div class="text-sm">Email:</div>
            <div>{{ cont.email }}</div>
          </div>
            
          </div>

          <div class="whitespace-nowrap font-medium">
            Mensagem: {{ cont.mensagem }}
          </div>
          <div class="whitespace-nowrap font-medium">
            Contato:
            <p>
            </p>
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

let queryContato = ref({
  origem: "formContato",
  q: "por_uf_count",
  uf: "",
});

const tab = ref("a")
let contatosUF = ref([]);
let contatos = ref([]);

function getContPorUf(uf) {
  queryContato.value.q = "por_uf";
  queryContato.value.uf = uf;
  getContatos();
}

onMounted(() => {
  getContatos();
});

async function getContatos() {
  await $fetch("/api/mailForm.php", {
    mode: "cors",
    method: "GET",
    params: { json: queryContato.value },
  }).then((R2) => {
    let CON = JSON.parse(R2);
    if (CON.codigo == 0) {
      if(queryContato.value.q == "por_uf_count"){
        contatosUF.value = [];
        contatosUF.value = CON.dados;
        
      }
      if(queryContato.value.q == "por_uf"){
        contatos.value = [];
        contatos.value = CON.dados;
      }
    } else {
      alert(CON.msg);
    }
   
  });
}
</script>
