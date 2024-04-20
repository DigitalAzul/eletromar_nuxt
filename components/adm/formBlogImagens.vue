<template>
  <div>
    <form action="https://localhost/mec/formBlogImagens.php" method="post">
      <div>
        <x-input
          v-model="blogImagens.imagemURL"
          label="imagemURL:"
          size="sm"
          name="imagemURL"
          placeholder="Placeholder"
          block
          type="file"
        />
      </div>
      <div>
        <label>Banner: </label>
        <input v-model="blogImagens.banner" type="radio" name="banner" />
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

let blogImagens = ref({
  id: "",
  blogID: "",
  imagemURL: "",
  banner: "",
});

function salvarForm() {
  console.log(blogImagens.value);
}
</script>
