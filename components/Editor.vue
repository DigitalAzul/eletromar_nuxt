<template>
  <div :id="idDiv" />
</template>
  
  <script>
export default {
  name: "Editor",
  props: {
    //existingContent: { type: Object, default: () => {} },
    existingContent: {},
    idContainer: "",
    resetEditor: "",
  },
  data() {
    return {
      editor: null,
      idDiv: null,
    };
  },
  watch: {
    resetEditor: {
      handler() {
        this.resetEd();
      },
    },
  },

  async mounted() {
    this.idDiv = this.idContainer;
    const editorOptions = {
      id: this.idContainer,
      data: this.existingContent,
      onChange: this.onChange,
    };

    this.editor = this.$editor(editorOptions);
    await this.editor.isReady;
  },
  methods: {
    async resetEd() {
      this.editor.clear();
    },

    async onChange() {
      try {
        const updatedData = await this.editor.save();
        this.$emit("contentChanged", updatedData);
      } catch (error) {
        //console.log("Saving failed: ", error);
      }
    },
  },
};
</script>