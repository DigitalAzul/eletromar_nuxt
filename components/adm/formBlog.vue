<template>
  <div class="relative flex h-screen w-full flex-row">
    <div
      id="overlayID"
      class="absolute left-0 top-0 z-[9999] hidden h-screen w-screen opacity-0 backdrop-blur-md"
    >
      <div class="flex h-full w-full flex-row items-center justify-center">
        <svg
          class="rotate-180 animate-spin"
          style="
            width: 10em;
            height: 10em;
            vertical-align: middle;
            fill: currentColor;
            overflow: hidden;
          "
          viewBox="0 0 1024 1024"
          version="1.1"
          xmlns="http://www.w3.org/2000/svg"
        >
          <path
            d="M853.333333 512c0-185.045333-156.288-341.333333-341.333333-341.333333v85.333333c138.752 0 256 117.248 256 256s-117.248 256-256 256v42.666667l-0.085333-42.666667h-0.469334a244.906667 244.906667 0 0 1-52.565333-5.717333l-18.346667 83.328c23.296 5.12 47.189333 7.722667 70.912 7.722666h0.64C697.088 853.290667 853.333333 697.002667 853.333333 512z"
            fill=""
          />
          <path
            d="M510.933333 85.333333L341.333333 213.333333l169.6 128zM170.666667 512c0 41.045333 7.466667 81.322667 22.144 119.808l79.744-30.421333a248.96 248.96 0 0 1-15.914667-107.349334l-85.077333-6.101333A322.218667 322.218667 0 0 0 170.666667 512z m161.194666-180.352L271.530667 271.232a348.074667 348.074667 0 0 0-78.933334 121.6l79.744 30.336a262.826667 262.826667 0 0 1 59.52-91.52z m17.749334 479.744l41.088-74.752a265.130667 265.130667 0 0 1-82.645334-71.509333l-68.010666 51.584a350.933333 350.933333 0 0 0 109.568 94.677333z"
            fill=""
          />
        </svg>
      </div>
    </div>
    <div
      class="flex max-h-screen w-[99%] ml-4 flex-row justify-center space-x-3 overflow-x-auto overflow-y-hidden p-6"
    >
      <div
        v-if="false"
        COLUNA="1"
        class="h-screen w-[350px] overflow-y-auto border-r-2 px-3"
      >
        <div v-if="formBlog.emEdicao == false" class="p-4 text-center text-3xl">
          BLOG
        </div>
        <div
          v-else
          class="animate-pulse bg-yellow-300 p-4 text-center text-3xl"
        >
          EM EDIÇÃO
        </div>

        <x-tab-group v-model="tab" class="pb-10" grow variant="line">
          <x-tab value="aa" label="Cadastro">
            <div>
              <form
                id="formBlogID"
                @submit.prevent="formRequest"
                enctype="multipart/form-data"
                XXboundary="---------------------------974767299852498929531610575"
                XXaction="https://localhost/mec/formBlog.php"
                XXXmethod="post"
                class="flex flex-col"
              >
                <div>
                  <x-select
                    size="sm"
                    v-model="formBlog.blog_posts_id"
                    label="Autor"
                    :options="autoresOPT"
                    placeholder="Autor"
                    class="w-full py-4"
                  />
                </div>
                <div>
                  <x-input
                    v-model="formBlog.titulo"
                    label="Titulo"
                    size="sm"
                    name="titulo"
                    block
                  />
                </div>
                <div>
                  <x-input
                    v-model="formBlog.titulo_en"
                    label="Titulo EN:"
                    size="sm"
                    name="tituloEN"
                    block
                  />
                </div>
                <div>
                  <x-input
                    v-model="formBlog.titulo_es"
                    label="Titulo ES:"
                    size="sm"
                    name="tituloES"
                    block
                  />
                </div>

                <div class="flex flex-col space-y-3 py-3 text-black">
                  <span>Imagem Banner 1x</span>
                  <div
                    class="flex flex-row items-center justify-between space-x-2"
                  >
                    <input
                      onchange="
                        document.getElementById('c2-banner-1').src =
                          window.URL.createObjectURL(this.files[0])
                      "
                      id="banner-1"
                      name="banner-1"
                      placeholder="Placeholder"
                      block
                      type="file"
                    />
                    <p
                      @click="resetProdFORMEdita(1)"
                      class="cursor-pointer text-3xl hover:text-red-400"
                    >
                      Xc
                    </p>
                  </div>
                  <span>Imagem Banner 2</span>
                  <div
                    class="flex flex-row items-center justify-between space-x-2"
                  >
                    <input
                      onchange="document.getElementById('c2-banner-2').src = window.URL.createObjectURL(this.files[0])"
                      id="banner-2"
                      name="banner-2"
                      placeholder="Placeholder"
                      block
                      type="file"
                    />
                    <p
                      @click="resetProdFORMEdita(1)"
                      class="cursor-pointer text-3xl hover:text-red-400"
                    >
                      X
                    </p>
                  </div>
                  <span>Imagem Banner 3</span>
                  <div
                    class="flex flex-row items-center justify-between space-x-2"
                  >
                    <input
                      onchange="document.getElementById('c2-banner-3').src = window.URL.createObjectURL(this.files[0])"
                      id="banner-3"
                      name="banner-3"
                      placeholder="Placeholder"
                      block
                      type="file"
                    />
                    <p
                      @click="resetProdFORMEdita(1)"
                      class="cursor-pointer text-3xl hover:text-red-400"
                    >
                      X
                    </p>
                  </div>
                </div>

                <div>
                  <x-input
                    v-model="formBlog.criado_em"
                    label="data:"
                    type="date"
                    name="data"
                    size="sm"
                    block
                  />
                </div>
                <p class="py-4">Texto Português</p>
                <div
                  class="h-[350px] overflow-clip overflow-y-auto rounded-lg border-2 border-slate-500 p-4"
                >
                  <Editor
                    :resetEditor="resetEditor"
                    :idContainer="'editorPT'"
                    :existingContent="editorContentBR"
                    @contentChanged="_onChangeBR"
                  />
                </div>

                <p class="py-4">Texto Inglês</p>
                <div
                  class="h-[350px] overflow-clip overflow-y-auto rounded-lg border-2 border-slate-500 p-4"
                >
                  <Editor
                    :resetEditor="resetEditor"
                    :idContainer="'editorEN'"
                    :existingContent="editorContentEN"
                    @contentChanged="_onChangeEN"
                  />
                </div>
                <p class="py-4">Texto Espanhol</p>
                <div
                  class="h-[350px] overflow-clip overflow-y-auto rounded-lg border-2 border-slate-500 p-4"
                >
                  <Editor
                    :resetEditor="resetEditor"
                    :idContainer="'editorES'"
                    :existingContent="editorContentES"
                    @contentChanged="_onChangeES"
                  />
                </div>

                <div class="flex flex-col space-y-3 py-3 text-black">
                  <span>Imagem blog 1</span>
                  <div
                    class="flex flex-row items-center justify-between space-x-2"
                  >
                    <input
                      id="arquivo-1"
                      onchange="document.getElementById('c2-textImg-1').src = window.URL.createObjectURL(this.files[0])"
                      label="imagemURL:"
                      name="imagemURL1"
                      placeholder="Placeholder"
                      block
                      type="file"
                    />
                    <p
                      @click="resetProdFORMEdita(1)"
                      class="cursor-pointer text-3xl hover:text-red-400"
                    >
                      X
                    </p>
                  </div>
                  <span>Imagem blog 2</span>
                  <div
                    class="flex flex-row items-center justify-between space-x-2"
                  >
                    <input
                      id="arquivo-2"
                      onchange="document.getElementById('c2-textImg-2').src = window.URL.createObjectURL(this.files[0])"
                      label="imagemURL:"
                      name="imagemURL2"
                      placeholder="Placeholder"
                      block
                      type="file"
                    />
                    <p
                      @click="resetProdFORMEdita(1)"
                      class="cursor-pointer text-3xl hover:text-red-400"
                    >
                      X
                    </p>
                  </div>
                  <span>Imagem Capa Blog</span>
                  <div
                    class="flex flex-row items-center justify-between space-x-2"
                  >
                    <input
                      onchange="document.getElementById('c2-capaTag-1').src = window.URL.createObjectURL(this.files[0])"
                      id="xc2-capa-1"
                      name="banner-1"
                      placeholder="Placeholder"
                      block
                      type="file"
                    />
                    <p
                      @click="resetProdFORMEdita(1)"
                      class="cursor-pointer text-3xl hover:text-red-400"
                    >
                      X
                    </p>
                  </div>
                </div>

                <div class="flex flex-col space-y-3 text-black"></div>
                <div>
                  <x-select
                    v-model="formBlog.categoria_id"
                    label="categoria"
                    :options="categoriasOPT"
                    placeholder="categoria"
                    class="w-full"
                  />
                </div>
                <div class="mt-4">
                  <x-textarea
                    v-model="formBlog.tags"
                    label="Tags"
                    name="Tags"
                    :adjust-to-text="false"
                    rows="2"
                    class="w-full"
                    style="display: block !important; width: 100%"
                  />
                </div>
                <div class="flex w-[90%] flex-row justify-between pt-10">
                  <x-button color="#000" light type="submit"> Salvar </x-button>
                  <x-button @click="resetFormBlog()" color="#000" light
                    >Cancelar</x-button
                  >
                </div>
              </form>
            </div>
          </x-tab>
          <x-tab value="b" label="Pesquisa">
            <div id="editorjs"></div>
            <div class="w-[400px] px-4 pt-10">
              <form @submit.prevent="getPostsBlog">
                <div>
                  <x-input
                    v-model="queryPostBlog.q"
                    label="Título:"
                    size="sm"
                    name="titulo"
                    class="w-4/5"
                  />
                </div>
                <div>
                  <x-input
                    v-model="queryPostBlog.autor"
                    label="Autor"
                    size="sm"
                    name="autor"
                    class="w-4/5"
                  />
                </div>
                <div class="flex w-[80%] flex-row justify-between pt-10">
                  <x-button color="#000" light type="submit">
                    Pesquisar
                  </x-button>
                  <x-button @click="resetFormPostBlogQuery()" color="#000" light
                    >Cancelar</x-button
                  >
                </div>
              </form>
            </div>
          </x-tab>
        </x-tab-group>
      </div>
      <!-- COLUNA A TAB A -->
      <div COLUNA="2" class="flex w-full justify-center overflow-x-auto">
        <x-tab-group
          class="md:w-[500px] lg:w-[925px] xl:w-[1260px] 2xl:w-[1414px] FHD:w-[1416px]"
          v-model="tab"
        >
          <x-tab value="a" label="CADASTRAR">
            <div class="flex flex-col space-y-3">
              <div class="flex flex-row justify-center gap-x-3">
                <div
                  class="relative flex h-[710px] flex-col justify-center overflow-x-auto overflow-y-hidden bg-slate-700"
                >
                  <!-- ENVELOPE INPUTS-->
                  <div
                    class="absolute right-0 top-0 w-[500px] bg-green-400 p-6 opacity-50 hover:opacity-100"
                  >
                    <div class="flex flex-col space-y-3 py-3 text-black">
                      <span>Imagem Banner 1</span>
                      <div
                        class="flex flex-row items-center justify-between space-x-2"
                      >
                        <input
                          onchange="
                        document.getElementById('c2-banner-1').src =
                          window.URL.createObjectURL(this.files[0])
                      "
                          @click="slideCarrouselBlog = 1"
                          id="bannerTag-1"
                          name="banner-1"
                          placeholder="Placeholder"
                          block
                          type="file"
                        />
                        <p
                          @click="resetProdFORMInput(1)"
                          class="cursor-pointer text-3xl hover:text-red-400"
                        >
                          X
                        </p>
                      </div>
                      <span>Imagem Banner 2</span>
                      <div
                        class="flex flex-row items-center justify-between space-x-2"
                      >
                        <input
                          onchange="document.getElementById('c2-banner-2').src = window.URL.createObjectURL(this.files[0])"
                          @click="slideCarrouselBlog = 2"
                          id="bannerTag-2"
                          name="banner-2"
                          placeholder="Placeholder"
                          block
                          type="file"
                          multiple
                        />
                        <p
                          @click="resetProdFORMInput(2)"
                          class="cursor-pointer text-3xl hover:text-red-400"
                        >
                          X
                        </p>
                      </div>
                      <span>Imagem Banner 3</span>
                      <div
                        class="flex flex-row items-center justify-between space-x-2"
                      >
                        <input
                          onchange="document.getElementById('c2-banner-3').src = window.URL.createObjectURL(this.files[0])"
                          @click="slideCarrouselBlog = 3"
                          id="bannerTag-3"
                          name="banner-3"
                          placeholder="Placeholder"
                          block
                          type="file"
                        />
                        <p
                          @click="resetProdFORMInput(3)"
                          class="cursor-pointer text-3xl hover:text-red-400"
                        >
                          X
                        </p>
                      </div>
                      <span>Imagem Capa Blog</span>
                      <div
                        class="flex flex-row items-center justify-between space-x-2"
                      >
                        <input
                          onchange="document.getElementById('c2-capa-1').src = window.URL.createObjectURL(this.files[0])"
                          @click="slideCarrouselBlog = 4"
                          id="c2-capaTag-1"
                          name="banner-1"
                          placeholder="Placeholder"
                          block
                          type="file"
                        />
                        <p
                          @click="resetProdFORMInput(4)"
                          class="cursor-pointer text-3xl hover:text-red-400"
                        >
                          X
                        </p>
                      </div>
                    </div>
                  </div>
                  <!-- imagens INPUTS-->
                  <div
                    class="flex h-[710px] w-[1415px] flex-col items-center justify-center"
                  >
                    <div
                      v-show="slideCarrouselBlog == 1"
                      class="h-[710px] w-[1415px]"
                    >
                      <img id="c2-banner-1" />
                    </div>
                    <div
                      v-show="slideCarrouselBlog == 2"
                      class="h-[710px] w-[1415px]"
                    >
                      <img id="c2-banner-2" />
                    </div>
                    <div
                      v-show="slideCarrouselBlog == 3"
                      class="h-[710px] w-[1415px]"
                    >
                      <img id="c2-banner-3" />
                    </div>
                    <div v-show="slideCarrouselBlog == 4" class="flex">
                      <img id="c2-capa-1" />
                    </div>
                  </div>
                  <!-- CONTROLES -->
                  <div
                    class="absolute bottom-2 left-1/2 flex -translate-x-1/2 flex-row gap-x-3"
                  >
                    <div
                      @click="slideCarrouselBlog = 1"
                      class="h-4 w-12 rounded-lg bg-green-500"
                      :class="{
                        'border-4 border-pink-600 ': slideCarrouselBlog == 1,
                      }"
                    ></div>
                    <div
                      @click="slideCarrouselBlog = 2"
                      class="h-4 w-12 rounded-lg bg-green-500"
                      :class="{
                        'border-4 border-pink-600 ': slideCarrouselBlog == 2,
                      }"
                    ></div>
                    <div
                      @click="slideCarrouselBlog = 3"
                      class="h-4 w-12 rounded-lg bg-green-500"
                      :class="{
                        'border-4 border-pink-600': slideCarrouselBlog == 3,
                      }"
                    ></div>
                    <div
                      @click="slideCarrouselBlog = 4"
                      class="h-4 w-12 rounded-lg bg-blue-500"
                      :class="{
                        'border-4 border-pink-600 ': slideCarrouselBlog == 4,
                      }"
                    ></div>
                  </div>
                </div>
              </div>

              <div
                class="container mx-auto flex flex-col space-y-3 px-24 pb-14"
              >
                <div class="flex flex-row space-x-5 py-3">
                  <div class="w-[360px]">
                    <x-input
                      v-model="formBlog.titulo"
                      label="Titulo PT"
                      size="sm"
                      name="titulo"
                      class="w-full"
                    />
                  </div>
                  <div class="w-[360px]">
                    <x-input
                      v-model="formBlog.titulo_en"
                      label="Titulo EN"
                      size="sm"
                      name="titulo"
                      class="w-full"
                    />
                  </div>
                  <div class="w-[360px]">
                    <x-input
                      v-model="formBlog.titulo_es"
                      label="Titulo ES"
                      size="sm"
                      name="titulo"
                      class="w-full"
                    />
                  </div>
                  <div class="w-[150px]">
                    <x-input
                      v-model="formBlog.criado_em"
                      label="data:"
                      type="date"
                      name="data"
                      size="sm"
                      class="w-full"
                    />
                  </div>
                </div>
                <div
                  class="container mx-auto space-y-5 rounded-lg bg-slate-400 p-6"
                >
                  <p class="text-lg">PARÁGRAFOS INICIAIS</p>
                  <div>
                    <div v-html="HTML"></div>
                    <p class="w-full text-center font-semibold">Português</p>
                    <!-- <div class="space-y-2">
                      <div class="w-full">
                        <x-textarea
                          v-model="formBlog.descricao[0].texto"
                          class="w-full"
                        />
                      </div>
                      <div class="w-full">
                        <x-textarea
                          v-model="formBlog.descricao[1].texto"
                          class="w-full"
                        />
                      </div>
                    </div> -->
                    <div
                      class="ql-containerPar container mx-auto my-10 h-auto w-[80%] bg-white"
                    >
                      <ClientOnly
                        fallback-tag="div"
                        fallback="Loading editor..."
                      >
                        <QuillEditor
                          :toolbar="toolsText"
                          @update:content="onQuillEditorChangePInicial"
                          ref="myEditorPa"
                          editorChange
                        />
                      </ClientOnly>
                    </div>
                  </div>
                  <div>
                    <p class="w-full text-center font-semibold">Inglês</p>
                    <div
                      class="container mx-auto my-10 h-auto w-[80%] bg-white"
                    >
                      <ClientOnly
                        fallback-tag="div"
                        fallback="Loading editor..."
                      >
                        <QuillEditor
                          :toolbar="toolsText"
                          @update:content="onQuillEditorChangePaENInicial"
                          ref="myEditorPaEN"
                          editorChange
                        />
                      </ClientOnly>
                    </div>
                  </div>
                  <div>
                    <p class="w-full text-center font-semibold">ESPANHOL</p>
                    <div
                      class="container mx-auto my-10 h-auto w-[80%] bg-white"
                    >
                      <ClientOnly
                        fallback-tag="div"
                        fallback="Loading editor..."
                      >
                        <QuillEditor
                          :toolbar="toolsText"
                          @update:content="onQuillEditorChangePaESInicial"
                          ref="myEditorPaES"
                          editorChange
                        />
                      </ClientOnly>
                    </div>
                  </div>
                </div>
                <div class="flex-rows flex justify-between space-x-3">
                  <div class="relative h-[525px] w-[725px] bg-slate-700">
                    <div
                      class="absolute right-0 top-0 flex h-[100px] w-[400px] flex-row items-center justify-between space-x-2 bg-white p-4 opacity-30 hover:opacity-100"
                    >
                      <input
                        id="arquivo-1"
                        onchange="document.getElementById('c2-textImg-1').src = window.URL.createObjectURL(this.files[0])"
                        label="imagemURL:"
                        name="imagemURL1"
                        placeholder="Placeholder"
                        block
                        type="file"
                      />
                      <p
                        @click="resetProdFORMInput(5)"
                        class="cursor-pointer text-3xl hover:text-red-400"
                      >
                        X
                      </p>
                    </div>
                    <img id="c2-textImg-1" class="h-[525px] object-cover" />
                  </div>
                  <div class="relative h-[525px] w-[725px] bg-slate-700">
                    <div
                      class="absolute right-0 top-0 flex h-[100px] w-[400px] flex-row items-center justify-between space-x-2 bg-white p-4 opacity-30 hover:opacity-100"
                    >
                      <input
                        id="arquivo-2"
                        onchange="document.getElementById('c2-textImg-2').src = window.URL.createObjectURL(this.files[0])"
                        label="imagemURL:"
                        name="imagemURL1"
                        placeholder="Placeholder"
                        block
                        type="file"
                      />
                      <p
                        @click="resetProdFORMInput(6)"
                        class="cursor-pointer text-3xl hover:text-red-400"
                      >
                        X
                      </p>
                    </div>
                    <img id="c2-textImg-2" class="h-[525px] object-cover" />
                  </div>
                </div>

                <div
                  class="container mx-auto space-y-5 rounded-lg bg-slate-400 p-6"
                >
                  <!-- <div
                    @click="addParagrafoBlog()"
                    class="flex w-56 cursor-pointer flex-row items-center gap-x-3 rounded-md pl-6 hover:bg-slate-500"
                  >
                    <span class="text-4xl">+</span>
                    <span class="text-lg">Parágrafos</span>
                    <span class="text-lg">
                      {{ formBlog.descricao.length - 2 }}</span
                    >
                  </div> -->
                  <div class="container mx-auto flex flex-col space-y-3">
                    <p class="w-full text-center font-semibold">PORTUGUÊS</p>
                    <div
                      class="container mx-auto my-10 h-auto w-[80%] bg-white"
                    >
                      <ClientOnly
                        fallback-tag="div"
                        fallback="Loading editor..."
                      >
                        <QuillEditor
                          :toolbar="toolsText"
                          @update:content="onQuillEditorChange"
                          ref="myEditor"
                          editorChange
                        />
                      </ClientOnly>
                    </div>

                    <!-- <div
                      v-show="indexPT > 1"
                      v-for="(lpt, indexPT) in formBlog.descricao"
                      :key="indexPT"
                      class="flex flex-row justify-between gap-x-3"
                    >
                      <div class="w-full space-y-3">
                        <ClientOnly
                          fallback-tag="div"
                          fallback="Loading editor..."
                        >
                          <QuillEditor
                            :toolbar="toolsText"
                            @update:content="onQuillEditorChangeEN"
                            ref="myEditorEN"
                            editorChange
                          />
                        </ClientOnly>
                        <x-textarea
                          v-model="lpt.texto"
                          class="w-full"
                          size="xl"
                        />
                      </div>
                      <div>
                        <x-button
                          class="h-8 w-8 text-sm hover:text-red-600"
                          @click="remParagrafoBlog(indexPT)"
                        >
                          X
                        </x-button>
                      </div>
                    </div> -->
                    <p class="w-full text-center font-semibold">INGLÊS</p>
                    <div
                      class="container mx-auto my-10 h-auto w-[80%] bg-white"
                    >
                      <ClientOnly
                        fallback-tag="div"
                        fallback="Loading editor..."
                      >
                        <QuillEditor
                          :toolbar="toolsText"
                          @update:content="onQuillEditorChangeEN"
                          ref="myEditorEN"
                          editorChange
                        />
                      </ClientOnly>
                    </div>
                    <!-- <div
                      v-show="indexEN > 1"
                      v-for="(len, indexEN) in formBlog.descricao_en"
                      :key="indexEN"
                      class="flex flex-row justify-between gap-x-3"
                    >
                      <div class="w-full space-y-3">
                        <x-textarea
                          v-model="len.texto"
                          class="w-full"
                          size="xl"
                        />
                      </div>
                    </div> -->

                    <p class="w-full text-center font-semibold">ESPANHOL</p>
                    <div
                      class="container mx-auto my-10 h-auto w-[80%] bg-white"
                    >
                      <ClientOnly
                        fallback-tag="div"
                        fallback="Loading editor..."
                      >
                        <QuillEditor
                          :toolbar="toolsText"
                          @update:content="onQuillEditorChangeES"
                          ref="myEditorES"
                          editorChange
                        />
                      </ClientOnly>
                    </div>

                    <!-- <div
                      v-show="indexES > 1"
                      v-for="(les, indexES) in formBlog.descricao_es"
                      :key="indexES"
                      class="flex flex-row justify-between gap-x-3"
                    >
                      <div class="w-full space-y-3">
                        <x-textarea
                          v-model="les.texto"
                          class="w-full"
                          size="xl"
                        />
                      </div>
                    </div> -->
                  </div>
                </div>
                <div class="flex flex-row space-x-10">
                  <div class="flex flex-col">
                    <div class="w-[250px]">
                      <x-select
                        size="sm"
                        v-model="formBlog.blog_autor_id"
                        label="Autor"
                        :options="autoresOPT"
                        placeholder="Autor"
                        class="w-full"
                      />
                    </div>
                    <div class="w-[250px]">
                      <x-select
                        v-model="formBlog.categoria_id"
                        label="categoria"
                        :options="categoriasOPT"
                        placeholder="categoria"
                        class="w-full"
                      />
                    </div>
                  </div>
                  <div>

                    <div>
                      <x-select
                        v-model="formBlog.tags"
                        label="Tags"
                        :options="tags"
                        multiple
                        class="w-64"
                      />
                    </div>
                  </div>
                </div>
                <div class="flex w-[90%] flex-row justify-between pt-10">
                  <x-button color="#000" light @click="formRequest">
                    Salvar
                  </x-button>
                  <x-button color="#000" light @click="excluirBlog()">
                    Excluir
                  </x-button>
                  <x-button @click="resetFormBlog()" color="#000" light
                    >Cancelar</x-button
                  >
                </div>
              </div>

              <div
                v-if="false"
                class="relative flex flex-row overflow-x-auto overflow-y-hidden bg-slate-500"
              >
                <!-- ENVELOPE INPUTS-->
                <div class="absolute right-0 h-[80px] w-[300px] bg-green-400">
                  <div>
                    <span>Todos</span>
                    <input type="file" id="images" accept="image/*" multiple />
                  </div>
                  <div>
                    <span>1</span>
                    <input type="file" id="images" accept="image/*" />
                  </div>
                  <div>
                    <span>2</span>
                    <input type="file" id="images" accept="image/*" />
                  </div>
                  <div>
                    <span>3</span>
                    <input type="file" id="images" accept="image/*" />
                  </div>
                </div>
                <!-- imagens INPUTS-->
                <div class="h-[710px] w-[1415px]">
                  <img src="/bd_imagens/blogImg1.png" />
                </div>
                <div class="h-[710px] w-[1415px]">
                  <img src="/bd_imagens/blogImg1.png" />
                </div>
                <div class="h-[710px] w-[1415px]">
                  <img src="/bd_imagens/blogImg1.png" />
                </div>
              </div>

            </div>
          </x-tab>
          <x-tab value="b" label="PESQUISAR">
            <div class="flex flex-col">
              <div class="mb-6 rounded-2xl bg-slate-700 p-14">
                <div class="w-[400px] px-4">
                  <form @submit.prevent="getPostsBlog">
                    <div class="flex flex-row items-end space-x-6">
                      <div class="w-[350px]">
                        <div class="w-[350px]">
                          <label>Título</label>
                          <x-input
                            v-model="queryPostBlog.q"
                            size="sm"
                            name="titulo"
                            class="w-full"
                          />
                        </div>
                        <div class="mt-4 w-[350px]">
                          <label>Autor</label>
                          <x-input
                            v-model="queryPostBlog.autor"
                            size="sm"
                            name="autor"
                            class="w-full"
                          />
                        </div>
                      </div>
                      <div>
                        <div
                          class="flex flex-row justify-between gap-x-4 pt-10"
                        >
                          <x-button color="#000" light type="submit">
                            Pesquisar
                          </x-button>
                          <x-button
                            @click="resetFormPostBlogQuery()"
                            color="#000"
                            light
                            >Cancelar</x-button
                          >
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
              <div>
                <div class="flex flex-row flex-wrap gap-2">
                  <div
                    v-for="(b, index) in blogPosts"
                    :key="index"
                    class="relative h-[670px] w-[485px] cursor-pointer"
                    @click="editaBlogPost(b)"
                  >
                    <div class="absolute left-2 top-2">
                      <x-popover align="left">
                        <x-button>ID: {{ b.id }}</x-button>
                        <template #content> </template>
                      </x-popover>
                    </div>

                    <img :src="pathBlogImagens + b.imagem_capa" />
                    <p
                      class="absolute bottom-10 w-full bg-black bg-opacity-25 p-4 text-center text-white"
                    >
                      {{ b.titulo }}
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </x-tab>
        </x-tab-group>
      </div>

      <!-- COLUNA A TAB A  if falso -->
      <div
        v-if="false"
        v-show="tab == 'a'"
        COLUNA="2"
        class="w-[1500px] overflow-x-auto"
      >
        <div class="flex flex-row space-x-3">
          <div
            class="flex h-[calc(100vh-50px)] w-[500px] flex-col space-y-2 overflow-x-auto text-center"
          >
            <p class="font-semibold uppercase">Carroussel Blog</p>
            <img id="xc2-banner-1" />
            <img id="xc2-banner-2" />
            <img id="xc2-banner-3" />
          </div>
          <div
            class="flex h-[calc(100vh-50px)] w-[500px] flex-col space-y-2 overflow-x-auto text-center"
          >
            <p class="font-semibold uppercase">Imagem dentro do Blog</p>
            <img id="xc2-textImg-1" />
            <img id="xc2-textImg-2" />
          </div>
          <div
            class="flex h-[calc(100vh-50px)] w-[500px] flex-col overflow-x-auto text-center"
          >
            <p class="font-semibold uppercase">Capa Blog</p>
            <img id="xc2-capaTag-1" />
          </div>
        </div>
      </div>

      <div
        v-if="false"
        v-show="tab == 'b'"
        COLUMA="2TB"
        class="w-[1500px] overflow-x-auto"
      >
        <!-- FOR DA PESQUISA -->
        <div class="flex flex-row flex-wrap gap-2">
          <div
            v-for="(b, index) in blogPosts"
            :key="index"
            class="relative h-[670px] w-[485px] cursor-pointer"
            @click="editaBlogPost(b)"
          >
            <div class="absolute left-2 top-2">
              <x-popover align="left">
                <x-button>ID: {{ b.id }}</x-button>
                <template #content> </template>
              </x-popover>
            </div>
            <img :src="pathBlogImagens + b.imagem_capa" />

            <p
              class="absolute bottom-10 w-full bg-black bg-opacity-25 p-4 text-center text-white"
            >
              {{ b.titulo }}
            </p>
          </div>
        </div>

        <!-- ESTE CODIGO SERA USADO NA HOME DO SITE /BLOG_DETALHES -->
        <div v-if="1 == 2">
          <div v-for="(b, index) in blogPosts" :key="index">
            <!-- CARROUSSEL DE IMAGENS -->

            <span v-for="(img, indexM) in b.imagens" :key="indexM">
              <img
                v-if="img.tipo == 1"
                :src="pathBlogImagens + img.imagem_url"
              />
            </span>

            <!-- DOIS PARAGRAFOS-->
            <div>
              <div>{{ b.titulo }}</div>
              <div class="uppercase">{{ b.data_br }}</div>
            </div>
            <div v-for="(bl, indexP) in b.descricao.blocks" :key="indexP">
              <div v-if="indexP < 2">
                <p class="p-6">
                  {{ bl.data.text }} <span class="text-3xl">{{ indexP }}</span>
                </p>
              </div>
            </div>

            <!-- DUAS IMAGENS -->
            <span v-for="(img, indexM) in b.imagens" :key="indexM">
              <img
                class="object-cover"
                v-if="img.tipo == 0"
                :src="pathBlogImagens + img.imagem_url"
              />
            </span>

            <div v-for="(bl, indexP2) in b.descricao.blocks" :key="indexP2">
              <div v-if="indexP2 > 1">
                <p class="p-6">
                  {{ bl.data.text }} <span class="text-3xl">{{ indexP2 }}</span>
                </p>
              </div>
            </div>
          </div>
        </div>
        <!-- ESTE CODIGO SERA USADO NA HOME DO SITE /BLOG_DETALHES -->
      </div>
      <!-- COLUNA A TAB A  if falso -->
    </div>
  </div>
</template>


<script setup>
import {
  createUI,
  XAlert,
  XButton,
  XPopover,
  XSelect,
  XTab,
  XTabGroup,
  XTable,
  XTextarea,
} from "@indielayer/ui";
import { Carousel } from "flowbite-vue";
import { onMounted } from "vue";
import Editor from "~/components/Editor.vue";

components: {
  createUI,
    XButton,
    XAlert,
    XTextarea,
    XSelect,
    Editor,
    XTab,
    XTabGroup,
    XTable,
    XPopover,
    Carousel;
}
const slideCarrouselBlog = ref(1);
const pictures = [
  {
    src: "/bd_imagens/blogImg1.png",
    alt: "Picture 1",
  },
  {
    src: "/bd_imagens/blogImg1.png",
    alt: "Picture 2",
  },
  {
    src: "/bd_imagens/blogImg1.png",
    alt: "Picture 3",
  },
  {
    src: "/bd_imagens/blogImg1.png",
    alt: "Picture 4",
  },
  {
    src: "/bd_imagens/blogImg1.png",
    alt: "Picture 5",
  },
];

const toolsText = ref([
  "bold",
  "italic",
  "underline",
  "strike",
  { size: ["small", false, "large", "huge"] },
  { list: "ordered" },
  { list: "bullet" },
  { indent: "-1" },
  { indent: "+1" },
  { header: [1, 2, 3, 4, 5, 6, false] },
  { align: [] },
]);
const quillTextoBlog = ref("");
const HTML = ref("");
const myEditor = ref(null);
const myEditorEN = ref(null);
const myEditorES = ref(null);
const myEditorPa = ref(null);
const myEditorPaEN = ref(null);
const myEditorPaES = ref(null);

function onQuillEditorChangePInicial() {
  formBlog.value.descricao[0].texto = myEditorPa.value.getHTML();
}

function onQuillEditorChangePaENInicial() {
  formBlog.value.descricao_en[0].texto = myEditorPaEN.value.getHTML();
}

function onQuillEditorChangePaESInicial() {
  formBlog.value.descricao_es[0].texto = myEditorPaES.value.getHTML();
}

function onQuillEditorChange() {
  formBlog.value.descricao[1].texto = myEditor.value.getHTML();
}

function onQuillEditorChangeEN() {
  // console.log(myEditor.value.getHTML());

  formBlog.value.descricao_en[1].texto = myEditorEN.value.getHTML();
}
function onQuillEditorChangeES() {
  // console.log(myEditor.value.getHTML());

  formBlog.value.descricao_es[1].texto = myEditorES.value.getHTML();
}

const paragrafosBlogData = ref({
  pt: [
    {
      texto: "",
      tipo: "PARAGRAFO",
    },
    {
      texto: "",
      tipo: "PARAGRAFO",
    },
  ],
  en: [
    {
      texto: "",
      tipo: "PARAGRAFO",
    },
    {
      texto: "",
      tipo: "PARAGRAFO",
    },
  ],
  es: [
    {
      texto: "",
      tipo: "PARAGRAFO",
    },
    {
      texto: "",
      tipo: "PARAGRAFO",
    },
  ],
});

async function excluirBlog(){

  console.log(formBlog.value);

  let blogExcluir = new FormData();
  blogExcluir.append("blogExcluir", JSON.stringify(formBlog.value));

  overLay();
  
  let R = await $fetch("/api/formBlogExcluir.php", {
    mode: "cors",
    method: "POST",
    body: blogExcluir,
  }).then((R) => {
    let RS = JSON.parse(R);
    if (RS.codigo == 0) {
      overLay();
      alert(RS.msg);
      resetFormBlog();
      resetProdFORMInput(9);
      
    } else {
      overLay();
      alert(RS.msg);
    }
  });
}


function addParagrafoBlog() {
  formBlog.value.descricao.push({
    texto: "",
    tipo: "PARAGRAFO",
  });
  formBlog.value.descricao_en.push({
    texto: "",
    tipo: "PARAGRAFO",
  });
  formBlog.value.descricao_es.push({
    texto: "",
    tipo: "PARAGRAFO",
  });
}
function remParagrafoBlog(index) {
  formBlog.value.descricao.splice(index, 1);
  formBlog.value.descricao_en.splice(index, 1);
  formBlog.value.descricao_es.splice(index, 1);
}
const tab = ref("a");

let editorContentBR = {};
let editorContentEN = {};
let editorContentES = {};

function _onChangeBR(data) {
  formBlog.value.descricao = JSON.stringify(data);
  editorContentBR = data;
}
function _onChangeEN(data) {
  formBlog.value.descricao_en = JSON.stringify(data);
  editorContentEN = data;
}
function _onChangeES(data) {
  formBlog.value.descricao_es = JSON.stringify(data);
  editorContentES = data;
}

if (process.client) {
}

const tagsOPT = ref([
  { value: "Marketing", label: "Marketing" },
  { value: "Operacional", label: "Operacional" },
]);
// const categoriasOPT = ref([
  //   { value: "1", label: "Marketing" },
  //   { value: "2", label: "Operacional" },
  //   { value: "3", label: "Residencial" },
  //   { value: "4", label: "Empresarial" },
  //   { value: "5", label: "Segurança" },
  //   { value: "6", label: "Energia" },
  //   { value: "7", label: "Família" },
  //   { value: "8", label: "Marketing" },
  //   { value: "9", label: "Mec-Tronic" },
  // ]);
  
const categoriasOPT = ref([]);
const queryCategoriaBlog = ref({
    q: "formBlog",
    offset: 0,
    qpag: 10,
  });

  async function getCategorias() {
    let R = await $fetch("/api/formCategoriasGet.php", {
      method: "GET",
      params: queryCategoriaBlog.value
    }).then((R) => {
        let r = JSON.parse(R);
        console.log("frrrr",r.dados);
      if (r.dados.length > 0) {
        r.dados.map((c)=>{
          categoriasOPT.value.push({value: c.id, label:c.titulo})
        })
       
      } else {
        categoriasOPT.value = [];  
      }
    });
  }

//" + Math.random().toString().substr(2)"
let novaTag = ref("");
let file = ref(null);

let formBlog = ref({
  emEdicao: false,
  titulo: "",
  titulo_en: "",
  titulo_es: " ",
  criado_em: new Date().toISOString().substring(0, 10),
  descricao: [
    {
      texto: "",
      tipo: "PARAGRAFO",
    },
    {
      texto: "",
      tipo: "PARAGRAFO",
    },
    {
      texto: "",
      tipo: "PARAGRAFO",
    },
  ],
  descricao_en: [
    {
      texto: "",
      tipo: "PARAGRAFO",
    },
    {
      texto: "",
      tipo: "PARAGRAFO",
    },
    {
      texto: "",
      tipo: "PARAGRAFO",
    },
  ],
  descricao_es: [
    {
      texto: "",
      tipo: "PARAGRAFO",
    },
    {
      texto: "",
      tipo: "PARAGRAFO",
    },
    {
      texto: "",
      tipo: "PARAGRAFO",
    },
  ],
  categoria_id: "1",
  blog_autor_id: 1,
  tags: "",
});
let arrayImgExcluir = ref([]);
let formBlogImgs = new FormData();
const countErros = ref(0);

function apendFile(n) {
  let arq;
  let arqData;

  countErros.value = 0;

  var entries = formBlogImgs.entries();
  for (var pair of entries) {
    formBlogImgs.delete(pair[0]);
  }

  formBlogImgs = new FormData();
  arrayImgExcluir.value = [];

  // IMAGEM BANNER BLOG
  arq = null;
  arq = document.getElementById("bannerTag-1");
  if (arq.files[0]) {
    arqData = arq.files[0];
    formBlogImgs.append("0", arqData);

    // IMAGEM PARA EXLUIR, FOI ATUALIZA
    if (formBlog.value.emEdicao == true && formBlog.value.imagens[0])
      arrayImgExcluir.value.push(formBlog.value.imagens[0].imagem_url);
  } else {
    if (!formBlog.value.emEdicao) {
      // VALIDACAO FORM
      alert("Insira a primeira imagem do Banner");
      countErros.value += 1;
      return;
    }
  }
  arq = null;
  arq = document.getElementById("bannerTag-2");
  if (arq.files[0]) {
    arqData = arq.files[0];
    formBlogImgs.append("1", arqData);
    // IMAGEM PARA EXLUIR, FOI ATUALIZA
    if (formBlog.value.emEdicao == true && formBlog.value.imagens[1]) {
      try {
        arrayImgExcluir.value.push(formBlog.value.imagens[1].imagem_url);
      } catch (error) {}
    }
  }
  arq = null;
  arq = document.getElementById("bannerTag-3");
  if (arq.files[0]) {
    arqData = arq.files[0];
    formBlogImgs.append("2", arqData);
    // IMAGEM PARA EXLUIR, FOI ATUALIZA
    if (formBlog.value.emEdicao == true && formBlog.value.imagens[2]) {
      try {
        arrayImgExcluir.value.push(formBlog.value.imagens[2].imagem_url);
      } catch (error) {}
    }
  }

  // ***** IMAGEM BLOG
  arq = document.getElementById("arquivo-1");
  if (arq.files[0]) {
    arqData = arq.files[0];
    formBlogImgs.append("3", arqData);
    // IMAGEM PARA EXLUIR, FOI ATUALIZA
    if (formBlog.value.emEdicao == true && formBlog.value.imagens[3])
      arrayImgExcluir.value.push(formBlog.value.imagens[3].imagem_url);
  }
  arq = null;
  arq = document.getElementById("arquivo-2");
  if (arq.files[0]) {
    arqData = arq.files[0];
    formBlogImgs.append("4", arqData);
    // IMAGEM PARA EXLUIR, FOI ATUALIZA
    if (formBlog.value.emEdicao == true && formBlog.value.imagens[4])
      arrayImgExcluir.value.push(formBlog.value.imagens[4].imagem_url);
  }

  arq = null;
  arq = document.getElementById("c2-capaTag-1");
  if (arq.files[0]) {
    arqData = arq.files[0];
    formBlogImgs.append("5", arqData);
    // IMAGEM PARA EXLUIR, FOI ATUALIZA
    if (formBlog.value.emEdicao == true && formBlog.value.imagens[5])
      arrayImgExcluir.value.push(formBlog.value.imagens[5].imagem_url);
  } else {
    if (!formBlog.value.emEdicao) {
      // VALIDACAO FORM
      alert("Insira a imagem de Capa");
      countErros.value += 1;
      return;
    }
  }

  if (formBlog.value.emEdicao == true) {
    formBlog.value.imgParaExcluir = arrayImgExcluir.value;
    arrayImgExcluir.value = [];
  }

  //ADD FORM JSON
  // ADD TEXTOS pt, en, es
  let FormBlogTMP = ref({});
  FormBlogTMP.value = Object.assign({}, formBlog.value);

  // formBlog.value.descricao = JSON.stringify(formBlog.value.descricao);
  // formBlog.value.descricao_en = JSON.stringify(formBlog.value.descricao_en);
  // formBlog.value.descricao_es = JSON.stringify(formBlog.value.descricao_es);

  FormBlogTMP.value.descricao = JSON.stringify(FormBlogTMP.value.descricao);
  FormBlogTMP.value.descricao_en = JSON.stringify(
    FormBlogTMP.value.descricao_en
  );
  FormBlogTMP.value.descricao_es = JSON.stringify(
    FormBlogTMP.value.descricao_es
  );

  formBlogImgs.append("json", JSON.stringify(FormBlogTMP.value));
}

async function addInfos() {
  await $fetch("https://localhost/mec/", {
    method: "POST",
    body: JSON.stringify(formBlog),
  });
}

///////
function formSubmit() {
  formRequest()
    .then((result) => {
      console.log(result);
    })
    .catch((error) => {
      console.error("Contact form could not be send", error);
    });
}

/// get posts
onMounted(() => {
  getPostsBlog();
  getAutorBlog();
  getTags();
  getCategorias();
});

let blogPosts = ref([]);

let queryPostBlog = ref({
  q: "",
  offset: 0,
  qpag: 30,
});

function editaBlogPost(blog) {
  // vai para o form
  tab.value = "a";
  overLay();
  setTimeout(() => {
    overLay();
    formBlog.value = blog;
    formBlog.value.emEdicao = true;

    // Paragrafos inicais
    myEditorPa.value.setHTML(blog.descricao[0].texto);
    myEditorPaEN.value.setHTML(blog.descricao_en[0].texto);
    myEditorPaES.value.setHTML(blog.descricao_es[0].texto);

    myEditor.value.setHTML(blog.descricao[1].texto);
    myEditorEN.value.setHTML(blog.descricao_en[1].texto);
    myEditorES.value.setHTML(blog.descricao_es[1].texto);

    // _onChangeBR(JSON.parse(blog.descricao));
    // _onChangeEN(JSON.parse(blog.descricao_en));
    // _onChangeES(JSON.parse(blog.descricao_es));

    const imgBanner = formBlog.value.imagens.filter((img) => img.tipo == 1);
    const imgTxt = formBlog.value.imagens.filter((img) => img.tipo == 0);
    const imgCapa = formBlog.value.imagens.filter((img) => img.tipo == 2);

    document.getElementById("c2-banner-1").src = imgBanner[0]
      ? pathBlogImagens + imgBanner[0].imagem_url
      : null;
    document.getElementById("c2-banner-2").src = imgBanner[1]
      ? pathBlogImagens + imgBanner[1].imagem_url
      : null;

    document.getElementById("c2-banner-3").src = imgBanner[2]
      ? pathBlogImagens + imgBanner[2].imagem_url
      : null;

    document.getElementById("c2-textImg-1").src = imgTxt[0]
      ? pathBlogImagens + imgTxt[0].imagem_url
      : null;
    document.getElementById("c2-textImg-2").src = imgTxt[1]
      ? pathBlogImagens + imgTxt[1].imagem_url
      : null;

    document.getElementById("c2-capa-1").src = imgCapa[0]
      ? pathBlogImagens + imgCapa[0].imagem_url
      : null;

    // let countImg0 = 0;
    // let countImg1 = 0;
    // let countImg2 = 0;
    // formBlog.value.imagens.map((i,index)=>{

    //   //IMAGEM TIPO MEIO DO TEXTO
    //   if(i.tipo == 0 && countImg0 == 0){
    //     document.getElementById("c2-textImg-1").src = pathBlogImagens + i.imagem_url;

    //   }
    //   if(i.tipo == 0 && countImg0 == 1){
    //     document.getElementById("c2-textImg-2").src = pathBlogImagens + i.imagem_url;

    //   }
    //   countImg0 +=1;

    //         //IMAGEM TIPO BANNER
    //   if(i.tipo == 1 && countImg1 == 0){
    //     document.getElementById("c2-banner-1").src = pathBlogImagens + i.imagem_url;

    //   }
    //   if(i.tipo == 1 && countImg1 == 1){
    //     document.getElementById("c2-banner-2").src = pathBlogImagens + i.imagem_url;

    //   }
    //   if(i.tipo == 1 && countImg1 == 2){
    //     document.getElementById("c2-banner-3").src = pathBlogImagens + i.imagem_url;

    //   }
    //   countImg1 +=1;

    //   //IMAGEM TIPO CAPA
    //   if(i.tipo == 2 && countImg2 == 0){
    //     document.getElementById("c2-capa-1").src = pathBlogImagens + i.imagem_url;

    //     countImg2 +=1;
    //   }

    // })

    // ICL 04 0923 h:2351
    // document.getElementById("c2-banner-1").src = formBlog.value.imagens[0]
    //   ? pathBlogImagens + formBlog.value.imagens[0].imagem_url
    //   : null;
    // document.getElementById("c2-banner-2").src = formBlog.value.imagens[1]
    //   ? pathBlogImagens + formBlog.value.imagens[1].imagem_url
    //   : null;
    // document.getElementById("c2-banner-3").src = formBlog.value.imagens[2]
    //   ? pathBlogImagens + formBlog.value.imagens[2].imagem_url
    //   : null;
    // document.getElementById("c2-textImg-1").src = formBlog.value.imagens[3]
    //   ? pathBlogImagens + formBlog.value.imagens[3].imagem_url
    //   : null;
    // document.getElementById("c2-textImg-2").src = formBlog.value.imagens[4]
    //   ? pathBlogImagens + formBlog.value.imagens[4].imagem_url
    //   : null;
    // document.getElementById("c2-capa-1").src = formBlog.value.imagens[5]
    //   ? pathBlogImagens + formBlog.value.imagens[5].imagem_url
    //   : null;

    // document.getElementById("c2-capaTag-1").src = formBlog.value.imagens[5]
    //   ? pathBlogImagens + formBlog.value.imagens[5].imagem_url
    //   : null;
  }, 3000);
}

function resetFormPostBlogQuery() {
  queryPostBlog.value = {
    q: "formBlog",
    offset: 0,
    qpag: 10,
  };
}
async function getPostsBlog() {
  overLay();
  let R = await $fetch(
    "/api/formBlog.php",

    {
      method: "GET",
      params: queryPostBlog.value,
    }
  ).then((R) => {
    let RS = JSON.parse(R);
    if (RS.codigo == 0) {
      overLay();
      if (RS.dados.length > 0) {
        blogPosts.value = RS.dados;
        blocksToArray();
      } else {
        blogPosts.value = [];
        alert("Sem resultados pra pesquisa !");
        overLay();
      }
    }
  });
}

const blogPostsAutor = ref([]);
const autoresOPT = ref([]);
async function getAutorBlog() {
  resetFormPostBlogQuery();
  queryPostBlog.value.q = "";
  let R = await $fetch("/api/formBlogAutor.php?todos", {
    method: "GET",
  }).then((R) => {
    let RS = JSON.parse(R);
    if (RS.codigo == 0) {
      if (RS.dados.length > 0) {
        blogPostsAutor.value = RS.dados;

        blogPostsAutor.value.map((a) => {
          autoresOPT.value.push({ value: a.id, label: a.nome });
        });
      } else {
        blogPostsAutor.value = [];
        alert("Sem resultados pra pesquisa !");
      }
    }
  });
}
const pathBlogImagens = "\\media\\blog\\";
function blocksToArray() {
  blogPosts.value.map((b, index) => {



    b.imagens.map((img) => {
      if (img.tipo == 2) {
        blogPosts.value[index].imagem_capa = img.imagem_url;
      }
    });

    blogPosts.value[index].descricao = JSON.parse(b.descricao);
    blogPosts.value[index].descricao_en = JSON.parse(b.descricao_en);
    blogPosts.value[index].descricao_es = JSON.parse(b.descricao_es);

    // corrige Tags
    let TG = [];
    blogPosts.value[index].tags.map((t, indexZ)=>{
      TG.push(t.tag_id);
    })
    console.log("TG",TG);
    blogPosts.value[index].tags = TG; 
  });
}

let resetEditor = "";
function resetFormBlog() {
  editorContentBR = {};
  editorContentEN = {};
  editorContentES = {};

  blogPosts.value = [];
  myEditorPa.value.setHTML("");
  myEditorPaEN.value.setHTML("");
  myEditorPaES.value.setHTML("");

  myEditor.value.setHTML("");
  myEditorEN.value.setHTML("");
  myEditorES.value.setHTML("");

  document.getElementById("c2-banner-1").src = null;
  document.getElementById("c2-banner-2").src = null;
  document.getElementById("c2-banner-3").src = null;
  document.getElementById("c2-textImg-1").src = null;
  document.getElementById("c2-textImg-2").src = null;
  document.getElementById("c2-capa-1").src = null;

  document.getElementById("c2-banner-1").src = "";
  document.getElementById("bannerTag-1").value = "";
  document.getElementById("c2-banner-2").src = "";
  document.getElementById("bannerTag-2").value = "";
  document.getElementById("c2-banner-3").src = "";
  document.getElementById("bannerTag-3").value = "";
  document.getElementById("c2-capa-1").src = "";
  document.getElementById("c2-capaTag-1").value = "";
  document.getElementById("arquivo-1").value = "";
  document.getElementById("c2-textImg-1").src = "";
  document.getElementById("arquivo-2").value = "";
  document.getElementById("c2-textImg-2").src = "";

  var entries = formBlogImgs.entries();
  for (var pair of entries) {
    formBlogImgs.delete(pair[0]);
  }

  resetEditor = randonico(7);
  formBlog.value = {
    emEdicao: false,
    titulo: "",
    titulo_en: "",
    titulo_es: "",
    data: new Date().toISOString().substring(0, 10),
    descricao: [
      {
        texto: "",
        tipo: "PARAGRAFO",
      },
      {
        texto: "",
        tipo: "PARAGRAFO",
      },
    ],
    descricao_en: [
      {
        texto: "",
        tipo: "PARAGRAFO",
      },
      {
        texto: "",
        tipo: "PARAGRAFO",
      },
    ],
    descricao_es: [
      {
        texto: "",
        tipo: "PARAGRAFO",
      },
      {
        texto: "",
        tipo: "PARAGRAFO",
      },
    ],
    categoria_id: "1",
    blog_autor_id: 1,
    tags: "",
  };
  formBlogImgs.delete("0");
  formBlogImgs.delete("1");
  formBlogImgs.delete("2");
  formBlogImgs.delete("3");
  formBlogImgs.delete("4");
  formBlogImgs.delete("5");
  formBlogImgs.delete("json");
  document.getElementById("banner-1").value = "";
  document.getElementById("banner-2").value = "";
  document.getElementById("banner-3").value = "";

  document.getElementById("arquivo-1").value = "";
  document.getElementById("arquivo-2").value = "";
  document.getElementById("c2-capa-1").value = "";

  document.getElementById("c2-banner-1").src = "";
  document.getElementById("c2-banner-2").src = "";
  document.getElementById("c2-banner-3").src = "";

  document.getElementById("c2-textImg-1").src = "";
  document.getElementById("c2-textImg-2").src = "";

  document.getElementById("c2-capaTag-1").src = "";
  document.body.scrollTo({ top: 0, behavior: "smooth" });
}
function resetProdFORMInput(input) {
  if (input) {
    switch (input) {
      case 1:
        document.getElementById("c2-banner-1").src = "";
        document.getElementById("bannerTag-1").value = "";
        break;
      case 2:
        document.getElementById("c2-banner-2").src = "";
        document.getElementById("bannerTag-2").value = "";
        break;
      case 3:
        document.getElementById("c2-banner-3").src = "";
        document.getElementById("bannerTag-3").value = "";
        break;
      case 4:
        document.getElementById("c2-capa-1").src = "";
        document.getElementById("c2-capaTag-1").value = "";
        break;
      case 5:
        document.getElementById("arquivo-1").value = "";
        document.getElementById("c2-textImg-1").src = "";

        break;
      case 6:
        document.getElementById("arquivo-2").value = "";
        document.getElementById("c2-textImg-2").src = "";
        break;
      case 9:
        document.getElementById("c2-banner-1").src = "";
        document.getElementById("bannerTag-1").value = "";
        document.getElementById("c2-banner-2").src = "";
        document.getElementById("bannerTag-2").value = "";
        document.getElementById("c2-banner-3").src = "";
        document.getElementById("bannerTag-3").value = "";
        document.getElementById("c2-capa-1").src = "";
        document.getElementById("c2-capaTag-1").value = "";
        document.getElementById("arquivo-1").value = "";
        document.getElementById("c2-textImg-1").src = "";
        document.getElementById("arquivo-2").value = "";
        document.getElementById("c2-textImg-2").src = "";
        break;
      default:
        break;
    }
  }
}

const queryTagBlog = ref({
    q: "formBlog",
    offset: 0,
    qpag: 10,
  });

let tags = ref([]);
// get tags
async function getTags() {
  let R = await $fetch("/api/formGetTags.php", {
    method: "GET",
    params: queryTagBlog.value
  }).then((R) => {
    let r = JSON.parse(R);
    if (r.dados.length > 0) {
      r.dados.map((t) => {
        let tg = {};
        console.log(t);
        tg.value = t.id;
        tg.label = t.titulo;
        tags.value.push(tg);
      });
    } else {
      tags.value = [];
    }
  });
}

// valida form blog
function validaFormBlog() {
  countErros.value = 0;

  if (formBlog.value.titulo.length < 5) {
    alert("Titulo em PT menor que 5 Caracteres.");
    countErros.value += 1;
    return;
  }
  if (formBlog.value.titulo_en.length < 5) {
    alert("Titulo em EN menor que 5 Caracteres.");
    countErros.value += 1;
    return;
  }
  if (formBlog.value.titulo_es.length < 5) {
    alert("Titulo em ES menor que 5 Caracteres.");
    countErros.value += 1;
    return;
  }

  if (
    !formBlog.value.criado_em instanceof Date ||
    !isNaN(formBlog.value.criado_em)
  ) {
    alert("Data Inválida");
    countErros.value += 1;
    return;
  }
}

//"Content-Type": "multipart/form-data",
async function formRequest() {
  apendFile();
  validaFormBlog();
  if (countErros.value > 0) {
    return;
  }

  overLay();

  let R = await $fetch("/api/formBlog.php", {
    mode: "cors",
    headers: {
      boundary: "---------------------------974767299852498929531610575",
    },
    method: "POST",
    body: formBlogImgs,
  }).then((R) => {
    let RS = JSON.parse(R);
    if (RS.codigo == 0) {
      overLay();
      alert(RS.msg);
      resetFormBlog();
      resetProdFORMInput(9);
    } else {
      overLay();
      alert(RS.msg);
    }
  });
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
//////

///// OVERLAY
function overLay() {
  var element = document.getElementById("overlayID");
  element.classList.toggle("overLayClass");
}
</script>

<style scope>
.ql-container {
  height: 400px;
  padding-bottom: 30px;
}

.overLayClass {
  display: block !important;
  opacity: 1;
  transition: all 0.5s ease;
}
</style>
