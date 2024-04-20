<template>
  <div class="flex h-screen w-[calc(100vw-180px)] flex-row">
    <div
      COLUNA="1"
      class="h-screen w-[500px] overflow-auto border-r border-slate-300 p-6"
    >
      <div class="p-4 text-center text-3xl">COMENTÁRIOS</div>
      <form
        @submit.prevent="formRequestComentarioAdd()"
        action="https://localhost/mec/formBlogComentarios.php"
        method="post"
      >
        <div>
          <label for="">Nome:</label>
          <x-input
            v-model="blogComentariosForm.nome"
            size="sm"
            name="nome"
            placeholder="Placeholder"
            block
          />
        </div>
        <div>
          <x-input
            v-model="blogComentariosForm.criado_em"
            label="data:"
            size="sm"
            name="data"
            placeholder="Placeholder"
            type="date"
            block
          />
        </div>
        <div>
          <x-textarea
            v-model="blogComentariosForm.comentario"
            label="Comentário:"
            name="comentario"
            :adjust-to-text="false"
            rows="8"
            style="display: block !important"
          />
        </div>
        <div>
          <x-textarea
            v-model="blogComentariosForm.resposta"
            label="Resposta:"
            name="resposta"
            :adjust-to-text="false"
            rows="8"
            style="display: block !important"
          />
        </div>
        <div>
          <x-input
            v-model="blogComentariosForm.email"
            label="Email:"
            size="sm"
            name="email"
            placeholder="Placeholder"
            type="email"
            block
          />
        </div>
        <div>
          <x-input
            v-model="blogComentariosForm.localidade"
            label="local:"
            size="sm"
            name="local"
            placeholder="Placeholder"
            block
          />
        </div>
        <div class="flex justify-end p-2 pt-3">
          <x-toggle
            v-model="blogComentariosForm.ativado"
            size="xl"
            :label="blogComentariosForm.ativado ? 'ATIVADO' : 'DESATIVADO'"
          />
        </div>
        <!-- <div>
            <x-input v-model="blogComentariosForm.imagemURL" label="imagemURL:" size="sm" name="imagemURL" block type="file" />
          </div> -->

        <div class="flex w-[80%] flex-row justify-between pt-10">
          <x-button color="#000" light type="submit"> Salvar </x-button>
          <x-button @click="resetBlogComentariosForm()" color="#000" light
            >Cancelar</x-button
          >
        </div>
      </form>
    </div>
    <div
      COLUNA="2"
      class="h-screen w-[500px] overflow-auto border-r border-slate-300"
    >
      <div>
        <div
          @click="getComentarios"
          class="flex cursor-pointer flex-col items-center justify-center py-3"
        >
          <ph-arrow-counter-clockwise :size="32" />
          <div>Recarregar</div>
        </div>
      </div>
      <div class="flex flex-col space-y-3 p-4">
        <div
          @click="editarComentario(bcoment)"
          v-for="(bcoment, index) in blogComentarios"
          :key="index"
          class="cursor-pointer rounded-xl border bg-white hover:bg-yellow-200"
        >
          <div class="p-4">
            <div>Nome: {{ bcoment.nome }}</div>
            <div>Data: {{ formData(bcoment.criado_em) }}</div>
            <div>Email: {{ bcoment.email }}</div>
            <div>Local: {{ bcoment.localidade }}</div>
            <div>
              <br />

              <div>{{ bcoment.comentario }}</div>
            </div>
          </div>
          <div>
            <div class="flex flex-row">
              <p
                @click="editarComentario(bcoment)"
                class="w-full rounded-b-xl bg-black p-2 text-center text-white"
              >
                RESPONDER
              </p>
            </div>
            <!-- <div v-if="formRespomder" class="p-4">
              <div v-if="Object.keys(bcoment).length > 0">
                <x-textarea
                  v-model="bcoment.resposta[0].texto"
                  label="Responder  Comentário:"
                  name="comentario"
                  :adjust-to-text="false"
                  rows="8"
                  style="display: block !important"
                />
              </div>
              <x-button
                @click="responderComentario(bcoment)"
                class="my-2 w-full p-2"
                >Salvar</x-button
              >
            </div> -->
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

let checked = true;
onMounted(() => {
  getComentarios();
});

const formRespomder = ref(false);
let blogComentariosForm = ref({
  id: "",
  emEdicao: false,
  nome: "",
  criado_em: "",
  comentario: "",
  email: "",
  localidade: "",
  imagem_url: "",
  ativado: false,
  resposta: "",
});
let blogComentarios = ref([
  {
    emEdicao: false,
    id: "",
    nome: "",
    criado_em: "",
    comentario: "",
    email: "",
    localidade: "",
    imagem_url: "",
    ativado: false,
    resposta: "",
  },
]);

function resetBlogComentariosForm() {
  blogComentariosForm.value = {
    emEdicao: false,
    id: "",
    nome: "",
    criado_em: "",
    comentario: "",
    email: "",
    localidade: "",
    imagem_url: "",
    ativado: false,
    resposta: "",
  };
}

// function responderComentario(comentario) {
//   resetBlogComentariosForm();
//   blogComentariosForm.value = comentario;
//   blogComentariosForm.value.emEdicao = false;

//   formRequestRespostaAdd();
// }
// async function formRequestRespostaAdd() {
//   //ADD FORM JSON
//   let formResposta = new FormData();
//   formResposta.append("json", JSON.stringify(blogComentariosForm.value));

//   const R = await $fetch("/api/formBlogComentariosResposta.php", {
//     mode: "cors",
//     method: "POST",
//     body: formResposta,
//   });
// }

function formData(datax) {
  let dataC = datax.split("-");

  return dataC[2] + "-" + dataC[1] + "-" + dataC[0];
}
function salvarForm() {
  // console.log(blogComentarios.value);
}

async function getComentarios() {
  let COM = await $fetch("/api/formBlogComentarios.php?todos", {
    method: "GET",
  }).then((COM) => {
    if (JSON.parse(COM).length > 0) {
      let C = JSON.parse(COM);
      let i = 0;
      C.forEach((c) => {
        if (c.ativado == "1") {
          C[i].ativado = true;
        } else {
          C[i].ativado = false;
        }
        i++;
      });

      blogComentarios.value = C;
    } else {
      blogComentarios.value = [];
      alert("Não há Comentários cadastrados !");
    }
  });
}

async function editarComentario(comentario) {
  console.log(comentario);

  blogComentariosForm.value = Object.assign({}, comentario);
  blogComentariosForm.value.emEdicao = true;
}
async function formRequestComentarioAdd() {
  //ADD FORM JSON
  let formComent = new FormData();
  formComent.append("json", JSON.stringify(blogComentariosForm.value));

  const R = await $fetch("/api/formBlogComentarios.php", {
    mode: "cors",
    method: "POST",
    body: formComent,
  }).then((R) => {
    alert(R);
    getComentarios();
    resetBlogComentariosForm();
  });
}
</script>
