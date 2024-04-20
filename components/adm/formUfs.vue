<template>
  <div>
    <form action="https://localhost/mec/formUfs.php" method="post">
      <div>
        <x-input
          v-model="Ufs.titulo"
          label="Estado:"
          size="sm"
          name="titulo"
          placeholder="Placeholder"
          block
        />
      </div>

      <input type="submit" value="Salvar" class="cursor-pointer" />
    </form>
  </div>
</template>

<script setup>
import { createUI, XButton, XAlert, XTextarea } from "@indielayer/ui";
components: {
  createUI, XButton, XAlert, XTextarea;
}

onMounted(() => {
  todasUfs();
});
let Ufs = ref([
  { nome: "Acre", sigla: "AC" },
  { nome: "Alagoas", sigla: "AL" },
  { nome: "Amapá", sigla: "AP" },
  { nome: "Amazonas", sigla: "AM" },
  { nome: "Bahia", sigla: "BA" },
  { nome: "Ceará", sigla: "CE" },
  { nome: "Distrito Federal", sigla: "DF" },
  { nome: "Espírito Santo", sigla: "ES" },
  { nome: "Goiás", sigla: "GO" },
  { nome: "Maranhão", sigla: "MA" },
  { nome: "Mato Grosso", sigla: "MT" },
  { nome: "Mato Grosso do Sul", sigla: "MS" },
  { nome: "Minas Gerais", sigla: "MG" },
  { nome: "Pará", sigla: "PA" },
  { nome: "Paraíba", sigla: "PB" },
  { nome: "Paraná", sigla: "PR" },
  { nome: "Pernambuco", sigla: "PE" },
  { nome: "Piauí", sigla: "PI" },
  { nome: "Rio de Janeiro", sigla: "RJ" },
  { nome: "Rio Grande do Norte", sigla: "RN" },
  { nome: "Rio Grande do Sul", sigla: "RS" },
  { nome: "Rondônia", sigla: "RO" },
  { nome: "Roraima", sigla: "RR" },
  { nome: "Santa Catarina", sigla: "SC" },
  { nome: "São Paulo", sigla: "SP" },
  { nome: "Sergipe", sigla: "SE" },
  { nome: "Tocantins", sigla: "TO" },
]);

async function todasUfs() {
  //ADD FORM JSON
  let formUf = new FormData();
  formUf.append("json", JSON.stringify(Ufs.value));

  const R = await $fetch("/api/formUfs.php", {
    mode: "cors",
    method: "POST",
    body: formUf,
  });
}

function salvarForm() {
  console.log(Ufs.value);
}
</script>
