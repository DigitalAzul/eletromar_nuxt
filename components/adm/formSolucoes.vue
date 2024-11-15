<template>
  <div class="flex h-screen w-[calc(100vw-20px)] flex-row">
    <div
      COLUNA="1"
      class="flex h-screen min-w-[500px] flex-col overflow-y-auto overflow-x-hidden border-r-2 p-6"
    >
      <div class="p-4 text-center text-3xl">SOLUÇÕES/PRODUTOS</div>
      <div class="w-[500px]">
        <x-tab-group v-model="tab" class="w-[90%] pb-10" variant="line" grow>
          <x-tab value="a" label="Cadastro">
            <div class="pt-6">
              <form @submit.prevent="formRequest">
                <div>
                  <x-input
                    v-model="solucoesForm.titulo"
                    label="Título:"
                    size="sm"
                    name="titulo"
                    block
                  />
                </div>
                <div>
                  <x-input
                    v-model="solucoesForm.titulo_en"
                    label="Título EN:"
                    size="sm"
                    name="titulo"
                    block
                  />
                </div>
                <div>
                  <x-input
                    v-model="solucoesForm.titulo_es"
                    label="Título ES:"
                    size="sm"
                    name="titulo"
                    block
                  />
                </div>

                <div>
                  <x-select
                    v-model="solucoesForm.linha_id"
                    label="categoria"
                    :options="solucaoLinhasOPT"
                    placeholder="categoria"
                    class="w-full"
                  />
                </div>

                <div>
                  <x-input
                    v-model="solucoesForm.codigo"
                    label="Código:"
                    size="sm"
                    name="codigo"
                    block
                  />
                </div>
                <div class="flex flex-col space-y-3 py-3 text-black">

                  <div>
                    <span>Imagem 1 (255 x 331) :: Frente</span>
                    <div
                      class="flex flex-row items-center justify-between space-x-2"
                    >
                      <input
                        id="imagemTag-1"
                        onchange="document.getElementById('imagem-1').src = window.URL.createObjectURL(this.files[0])"
                        name="imagem-1"
                        type="file"
                        accept="image/png, image/jpeg"
                      />
                      />
                      <p
                        @click="resetProdFORM(1)"
                        class="cursor-pointer text-3xl hover:text-red-400"
                      >
                        X
                      </p>
                    </div>
                  </div>
                  <div>
                    <span>Imagem 2 (255 x 331) :: Lateral</span>
                    <div
                      class="flex flex-row items-center justify-between space-x-2"
                    >
                      <input
                        id="imagemTag-2"
                        onchange="document.getElementById('imagem-2').src = window.URL.createObjectURL(this.files[0])"
                        name="imagem-2"
                        placeholder="imagem"
                        block
                        type="file"
                        accept="image/png, image/jpeg"
                      />
                      />
                      <p
                        @click="resetProdFORM(2)"
                        class="cursor-pointer text-3xl hover:text-red-400"
                      >
                        X
                      </p>
                    </div>
                  </div>
                  <div>
                    <span>Imagem 3 (255 x 331) :: Outra</span>
                    <div
                      class="flex flex-row items-center justify-between space-x-2"
                    >
                      <input
                        id="imagemTag-3"
                        onchange="document.getElementById('imagem-3').src =
                      window.URL.createObjectURL(this.files[0])"
                        name="imagem-3"
                        placeholder="imagem"
                        block
                        type="file"
                        accept="image/png,
                      image/jpeg"
                      />
                      />
                      <p
                        @click="resetProdFORM(3)"
                        class="cursor-pointer text-3xl hover:text-red-400"
                      >
                        X
                      </p>
                    </div>
                  </div>

                  <!-- RETIRADO 30 10 2024 -->
                  <div
                  v-if="false"
                  >
                    <span>Video destaque</span>
                    <div
                      class="flex flex-row items-center justify-between space-x-2"
                    >
                      <input
                        id="videoTag"
                        onchange="document.getElementById('video').src = window.URL.createObjectURL(this.files[0])"
                        type="file"
                        name="video_destaque"
                        placeholder="video"
                        block
                        accept="video/*.mp4"
                      />
                      <p
                        @click="resetProdFORM(4)"
                        class="cursor-pointer text-3xl hover:text-red-400"
                      >
                        X
                      </p>
                    </div>
                  </div>


                  <div class="p-4 bg-slate-400">
                    <span class="font-semibold">Arquivo DWG</span>
                    <div
                      class="flex flex-row items-center justify-between space-x-2 pt-2"
                    >
                      <input
                        id="dwgTag-1"
                        name="dwgTag-1"
                        type="file"
                        accept="image/x-dwg, image/x-dxf, drawing/x-dwf, application/pdf"
                      />
                      <p
                        @click="resetProdFORM(6)"
                        class="cursor-pointer text-3xl hover:text-red-400"
                      >
                        X
                      </p>
                    </div>
                  </div>
                </div>
                <div>
                  <x-textarea
                    v-model="solucoesForm.descricao"
                    label="Descrição:"
                    name="descricao"
                    :adjust-to-text="false"
                    rows="4"
                    style="display: block !important"
                  />
                </div>
                <div>
                  <x-textarea
                    v-model="solucoesForm.descricao_en"
                    label="Descrição EN:"
                    name="descricaoEN"
                    :adjust-to-text="false"
                    rows="4"
                    style="display: block !important"
                  />
                </div>
                <div>
                  <x-textarea
                    v-model="solucoesForm.descricao_es"
                    label="Descrição ES:"
                    name="descricaoES"
                    :adjust-to-text="false"
                    rows="4"
                    style="display: block !important"
                  />
                </div>
                <div class="flex justify-end p-2 pt-3">
                  <x-toggle
                    v-model="solucoesForm.destaque"
                    size="xl"
                    :label="
                      solucoesForm.destaque ? 'EM DESTAQUE' : 'NÃO DESTAQUE'
                    "
                  />
                </div>

                <div
                  id="submitButtonAddSoluID"
                  class="flex flex-row justify-between p-10"
                >
                  <input type="submit" value="Salvar" class="cursor-pointer" />
                  <p class="cursor-pointer" @click="resetProdFORM(5)">
                    Cancelar
                  </p>
                </div>
              </form>
            </div>
          </x-tab>
          <x-tab value="b" label="Pesquisa">
            <div v-if="produtoEmEdicao.emEdicao == false" class="py-10">
              <div class="flex flex-col space-y-3 px-10">
                <div>
                  <x-input
                    @keyup.enter.exact.stop.prevent="getSolucoes()"
                    v-model="querySolucoes.q"
                    label="Por titulo:"
                    size="sm"
                    name="titulo"
                    placeholder="+ de 3 Caracteres"
                    block
                  />
                </div>
                <div>
                  <x-input
                    @keyup.enter.exact.stop.prevent="getSolucoes()"
                    v-model="querySolucoes.c"
                    label="Por código:"
                    size="sm"
                    name="Codigo"
                    block
                  />
                </div>
              </div>
              <div controles="" class="p-10">
                <x-button @click="getSolucoes()"> Pesquisar</x-button>
              </div>
            </div>

            <!-- EDICAO PRODUTO -->
            <div v-if="produtoEmEdicao.emEdicao == true" class="pt-6">
              <form @submit.prevent="formRequestEdita">
                <div>
                  <x-input
                    v-model="produtoEmEdicao.titulo"
                    label="Título:"
                    size="sm"
                    name="titulo"
                    block
                  />
                </div>
                <div>
                  <x-input
                    v-model="produtoEmEdicao.titulo_en"
                    label="Título EN:"
                    size="sm"
                    name="tituloEN"
                    block
                  />
                </div>
                <div>
                  <x-input
                    v-model="produtoEmEdicao.titulo_es"
                    label="Título ES:"
                    size="sm"
                    name="tituloES"
                    block
                  />
                </div>

                <div>
                  <x-select
                    v-model="produtoEmEdicao.linha_id"
                    label="categoria"
                    :options="solucaoLinhasOPT"
                    placeholder="categoria"
                    class="w-full"
                  />
                </div>

                <div>
                  <x-input
                    v-model="produtoEmEdicao.codigo"
                    label="Código:"
                    size="sm"
                    name="codigo"
                    block
                  />
                </div>
                <div class="flex flex-col space-y-3 py-3 text-black">
                  <div>
                    <span>Imagem 1 (255 x 331)</span>
                    <div
                      class="flex flex-row items-center justify-between space-x-2"
                    >
                      <input
                        id="imagemTag-1b"
                        :src="pathSolucoes + produtoEmEdicao.img_1"
                        onchange="document.getElementById('imagem-1b').src = window.URL.createObjectURL(this.files[0])"
                        name="imagem-1"
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
                    <span>Imagem 2 (255 x 331)</span>
                    <div
                      class="flex flex-row items-center justify-between space-x-2"
                    >
                      <input
                        id="imagemTag-2b"
                        onchange="document.getElementById('imagem-2b').src = window.URL.createObjectURL(this.files[0])"
                        name="imagem-2"
                        placeholder="imagem"
                        block
                        type="file"
                      />
                      <p
                        @click="resetProdFORMEdita(2)"
                        class="cursor-pointer text-3xl hover:text-red-400"
                      >
                        X
                      </p>
                    </div>
                  </div>
                  <div>
                    <span>Imagem 3 (255 x 331)</span>
                    <div
                      class="flex flex-row items-center justify-between space-x-2"
                    >
                      <input
                        id="imagemTag-3b"
                        onchange="document.getElementById('imagem-3b').src = window.URL.createObjectURL(this.files[0])"
                        name="imagem-3"
                        placeholder="imagem"
                        block
                        type="file"
                      />
                      <p
                        @click="resetProdFORMEdita(3)"
                        class="cursor-pointer text-3xl hover:text-red-400"
                      >
                        X
                      </p>
                    </div>
                  </div>

                  <!-- RETIRADO EM 30 10 2024 -->
                  <div
                  v-if="false"
                  >
                    <span>Video MP4</span>
                    <div
                      class="flex flex-row items-center justify-between space-x-2"
                    >
                      <input
                        id="videoTag-1b"
                        onchange="document.getElementById('video-1b').src = window.URL.createObjectURL(this.files[0])"
                        type="file"
                        name="video-1"
                        placeholder="video"
                        block
                      />
                      <!-- <p @click="resetProdFORMEdita(3)" class="text-3xl cursor-pointer hover:text-red-400">X</p> -->
                    </div>
                  </div>


                  <div class="p-4 bg-slate-400">
                    <span class="font-semibold">Arquivo DWG ed</span>
                    <div
                      class="flex flex-row items-center justify-between space-x-2 pt-2"
                    >
                      <input
                        id="dwgTag-1b"
                        name="dwgTag-1"
                        type="file"
                        accept="image/x-dwg, image/x-dxf, drawing/x-dwf, application/pdf"
                      />
                      />
                      <p
                        @click="resetProdFORM(6)"
                        class="cursor-pointer text-3xl hover:text-red-400"
                      >
                        X
                      </p>
                    </div>
                  </div>
                </div>
                <div>
                  <x-textarea
                    v-model="produtoEmEdicao.descricao"
                    label="Descrição:"
                    name="descricao"
                    :adjust-to-text="false"
                    rows="4"
                    style="display: block !important"
                  />
                </div>
                <div>
                  <x-textarea
                    v-model="produtoEmEdicao.descricao_en"
                    label="Descrição EN:"
                    name="descricaoEN"
                    :adjust-to-text="false"
                    rows="4"
                    style="display: block !important"
                  />
                </div>
                <div>
                  <x-textarea
                    v-model="produtoEmEdicao.descricao_es"
                    label="Descrição ES:"
                    name="descricaoES"
                    :adjust-to-text="false"
                    rows="4"
                    style="display: block !important"
                  />
                </div>
                <div class="flex justify-end p-2 pt-3">
                  <x-toggle
                    v-model="produtoEmEdicao.destaque"
                    size="xl"
                    :label="produtoEmEdicao.destaque ? 'ATIVADO' : 'DESATIVADO'"
                  />
                </div>
                <div
                  id="submitButtonEditaSoluID"
                  class="flex flex-row justify-between p-10"
                >
                  <input
                    type="submit"
                    value="Atualizar"
                    class="cursor-pointer"
                  />
                  <p class="cursor-pointer" @click="resetProdFORMEdita(4)">
                    Cancelar
                  </p>
                </div>
              </form>
            </div>
          </x-tab>
          <x-tab value="c" label="Arquivo TXT">
            <form @submit.prevent="formRequestCsv">
              <div class="flex flex-col space-y-4">
                <div class="p-6">
                  <x-select
                    v-model="formArquivoTXT.linha_id"
                    label="LINHA"
                    :options="solucaoLinhasOPT"
                    placeholder="Linha"
                    class="w-full"
                  />
                </div>
                <div
                  class="flex flex-row items-center justify-between space-x-2 p-6 py-10"
                >

                  <input
                    id="arquivotxtID"
                    placeholder="Arquivo TXT"
                    block
                    type="file"
                    accept=".csv"
                  />
                  <p
                    @click="resetFormCsv"
                    class="cursor-pointer text-3xl hover:text-red-400"
                  >
                    X
                  </p>
                </div>
              </div>
              <div
                id="submitButtonAddSoluID"
                class="flex flex-row justify-between p-10"
              >
                <input
                  v-if="!formCsvValido"
                  type="submit"
                  value="VALIDAR"
                  class="h-10 w-[200px] cursor-pointer rounded-md bg-yellow-500 text-white"
                />
                <input
                  v-if="formCsvValido"
                  type="submit"
                  value="SALVAR"
                  class="h-10 w-[200px] cursor-pointer rounded-md bg-green-500 text-white"
                />
                <p class="cursor-pointer" @click="resetFormCsv">Cancelar</p>
              </div>
            </form>
          </x-tab>
        </x-tab-group>
      </div>
    </div>

    <!-- TAB A -->
    <div
      v-if="tab == 'a'"
      COLUNA="2"
      class="flex w-full flex-row items-center justify-center overflow-auto"
    >
      <div class="container flex shrink-0 flex-row space-x-2 overflow-auto">
        <div>
          <div
            class="flex h-[640px] w-full flex-row items-center justify-center overflow-hidden bg-[#004425] lg:w-[460px]"
          >
            <img id="imagem-1" class="object-fill" />
          </div>
        </div>

        <div>
          <div
            class="flex h-[640px] w-full flex-row items-center justify-center overflow-hidden bg-[#004425] lg:w-[460px]"
          >
            <img id="imagem-2" class="object-fill" />
          </div>
        </div>

        <div>
          <div
            class="flex h-[640px] w-full flex-row items-center justify-center overflow-hidden bg-[#004425] lg:w-[460px]"
          >
            <img id="imagem-3" class="object-fill" />
          </div>
        </div>

        <!-- RETIRADO 30 10 2024 -->
        <div
        v-if="false"
        >
          <div
            class="flex h-[640px] w-full flex-row items-center justify-center overflow-hidden bg-[#004425] lg:w-[460px]"
          >
            <video
              id="video"
              muted
              playsinline
              loop
              autoplay
              class="object-fill"
            ></video>
          </div>
        </div>


      </div>
    </div>

    <!-- TAB B -->
    <div v-if="tab == 'b'">
      <div class="h-screen overflow-auto">
        <!-- LINHA DE IMAGENS ATUAIS -->
        <div class="container mx-auto flex flex-row flex-wrap pt-6">
          <div
            v-for="(p, index) in produtoDetalhe"
            :key="index"
            class="relative flex justify-center"
            @click="editaSolucao(p)"
          >
            <div class="absolute left-2 top-2 z-[99999]">
              <x-popover align="left">
                <x-button>COD: {{ p.codigo }}</x-button>
                <template #content>
                  <x-popover-container class="w-80 p-3">
                    {{ p.descricao }}
                  </x-popover-container>
                </template>
              </x-popover>
            </div>
            <div class="flex flex-col lg:space-y-3">
              <div class="h-[640px] w-full lg:w-[460px]">
                <div
                  class="slides h-[640px] w-full space-x-1 border-[2px] border-[#c3d3cb] lg:w-[460px]"
                >
                  <div
                    class="slide first flex h-[640px] w-full flex-row items-center justify-center bg-[#004425] lg:w-[460px]"
                  >
                    <img
                      :src="pathSolucoes + '\\' + p.link + '\\' + p.img_1"
                      alt=""
                      width=""
                      height=""
                      class="object-fill"
                    />
                  </div>
                  <div
                    class="slide flex h-[640px] w-full flex-row items-center justify-center bg-[#004425] lg:w-[460px]"
                  >
                    <img
                      :src="pathSolucoes + '\\' + p.link + '\\' + p.img_2"
                      alt=""
                      width=""
                      height=""
                      class="object-fill"
                    />
                  </div>
                  <div
                    class="slide flex h-[640px] w-full flex-row items-center justify-center bg-[#004425] lg:w-[460px]"
                  >
                    <img
                      :src="pathSolucoes + '\\' + p.link + '\\' + p.img_3"
                      alt=""
                      width=""
                      height=""
                      class="object-fill"
                    />
                  </div>
                  <div
                    class="slide flex h-[640px] w-full flex-row items-center justify-center bg-[#004425] lg:w-[460px]"
                  >
                    <video
                      :src="pathSolucoes + '\\' + p.link + '\\' + p.video_destaque"
                      muted
                      playsinline
                      loop
                      autoplay
                      name="video_destaque"
                    ></video>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- LINHA DE IMAGENS ATUALIZADAS -->
        <div
          v-if="produtoEmEdicao.emEdicao == true"
          class="container mx-auto flex flex-row pt-6"
        >
          <div class="flex w-[90%] shrink-0 flex-row space-x-2 overflow-auto">
            <div>
              <div
                class="flex h-[640px] w-full flex-row items-center justify-center overflow-hidden bg-[#004425] lg:w-[460px]"
              >
                <img id="imagem-1b" class="object-fill" />
              </div>
            </div>

            <div>
              <div
                class="flex h-[640px] w-full flex-row items-center justify-center overflow-hidden bg-[#004425] lg:w-[460px]"
              >
                <img id="imagem-2b" class="object-fill" />
              </div>
            </div>

            <div>
              <div
                class="flex h-[640px] w-full flex-row items-center justify-center overflow-hidden bg-[#004425] lg:w-[460px]"
              >
                <img id="imagem-3b" class="object-fill" />
              </div>
            </div>

            <div>
              <div
                class="flex h-[640px] w-full flex-row items-center justify-center overflow-hidden bg-[#004425] lg:w-[460px]"
              >
                <video
                  id="video-1b"
                  muted
                  playsinline
                  loop
                  autoplay
                  class="object-fill"
                ></video>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- TAB C -->
    <div v-if="tab == 'c'"
    class="-mb-3 mt-4 w-full">
      <div
        class="not-prose relative overflow-hidden rounded-xl bg-slate-50 dark:bg-slate-800/25"
      >
        <div
          style="background-position: 10px 10px"
          class="bg-grid-slate-100 dark:bg-grid-slate-700/25 absolute inset-0 [mask-image:linear-gradient(0deg,#fff,rgba(255,255,255,0.6))] dark:[mask-image:linear-gradient(0deg,rgba(255,255,255,0.1),rgba(255,255,255,0.5))]"
        ></div>
        <div class="relative overflow-auto rounded-xl">
          <div class="my-8 overflow-auto h-[calc(100vh-100px)] shadow-sm w-[calc(100vw-550px)]">
            <table class="w-full table-auto border-collapse text-sm overflow-auto">
              <thead>
                <tr>
                  <th
                    class="border-b p-4 pb-3 pl-8 pt-0 text-left font-medium text-slate-400 dark:border-slate-600 dark:text-slate-200"
                  >
                    Código
                  </th>

                  <th
                    class="border-b p-4 pb-3 pr-8 pt-0 text-left font-medium text-slate-400 dark:border-slate-600 dark:text-slate-200"
                  >
                    Título
                  </th>
                  <th
                    class="border-b p-4 pb-3 pr-8 pt-0 text-left font-medium text-slate-400 dark:border-slate-600 dark:text-slate-200"
                  >
                    Título EN
                  </th>
                  <th
                    class="border-b p-4 pb-3 pr-8 pt-0 text-left font-medium text-slate-400 dark:border-slate-600 dark:text-slate-200"
                  >
                    Título ES
                  </th>
                  <th
                    class="border-b p-4 pb-3 pr-8 pt-0 text-left font-medium text-slate-400 dark:border-slate-600 dark:text-slate-200"
                  >
                    Descrição
                  </th>
                  <th
                    class="border-b p-4 pb-3 pr-8 pt-0 text-left font-medium text-slate-400 dark:border-slate-600 dark:text-slate-200"
                  >
                    Descrição EN
                  </th>
                  <th
                    class="border-b p-4 pb-3 pr-8 pt-0 text-left font-medium text-slate-400 dark:border-slate-600 dark:text-slate-200"
                  >
                    Descrição ES
                  </th>
                  <th
                    class="border-b p-4 pb-3 pr-8 pt-0 text-left font-medium text-slate-400 dark:border-slate-600 dark:text-slate-200"
                  >
                    Imagem 0
                  </th>
                  <th
                    class="border-b p-4 pb-3 pr-8 pt-0 text-left font-medium text-slate-400 dark:border-slate-600 dark:text-slate-200"
                  >
                    Imagem 1
                  </th>
                  <th
                    class="border-b p-4 pb-3 pr-8 pt-0 text-left font-medium text-slate-400 dark:border-slate-600 dark:text-slate-200"
                  >
                    Imagem 2
                  </th>
                </tr>
              </thead>
              <tbody class="bg-white dark:bg-slate-800">
                <tr v-for="(s, index) in solucaoCsv" :key="index"
                class="text-black"
                :class="{'bg-red-500 text-white': s[8] == 'duplicado'}"
                >
                  <td
                    class="border-b border-slate-100 p-4 pl-8  dark:border-slate-700 dark:text-slate-400"
                  >
                    {{ s[3] }}
                  </td>

                  <td
                    class="border-b border-slate-100 p-4 pr-8  dark:border-slate-700 dark:text-slate-400"
                  >
                    {{ s[0] }}
                  </td>
                  <td
                    class="border-b border-slate-100 p-4 pr-8  dark:border-slate-700 dark:text-slate-400"
                  >
                    {{ s[1] }}
                  </td>
                  <td
                    class="border-b border-slate-100 p-4 pr-8  dark:border-slate-700 dark:text-slate-400"
                  >
                    {{ s[2] }}
                  </td>
                  <td
                    class="border-b border-slate-100 p-4 pr-8  dark:border-slate-700 dark:text-slate-400"
                  >
                    <p v-for="(d, index) in s[4]" :key="index">{{d}}</p>

                  </td>
                  <td
                    class="border-b border-slate-100 p-4 pr-8  dark:border-slate-700 dark:text-slate-400"
                  >
                    <p v-for="(d, index) in s[5]" :key="index">{{d}}</p>
                  </td>
                  <td
                    class="border-b border-slate-100 p-4 pr-8  dark:border-slate-700 dark:text-slate-400"
                  >
                  <p v-for="(d, index) in s[6]" :key="index">{{d}}</p>
                  </td>
                  <td
                    class="border-b border-slate-100 p-4 pr-8  dark:border-slate-700 dark:text-slate-400 break-words max-w-[300px]"
                  >
                  <p >{{s[7]}}</p>
                  </td>
                  <td
                    class="border-b border-slate-100 p-4 pr-8  dark:border-slate-700 dark:text-slate-400 break-words max-w-[300px]"
                  >
                  <p >{{s[8]}}</p>
                  </td>
                  <td
                    class="border-b border-slate-100 p-4 pr-8  dark:border-slate-700 dark:text-slate-400 break-words max-w-[300px]"
                  >
                  <p >{{s[9]}}</p>
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
</template>

<script setup>
import {
  createUI,
  XButton,
  XAlert,
  XTextarea,
  XSelect,
  XTab,
  XTabGroup,
  XPopover,
} from "@indielayer/ui";
components: {
  createUI, XButton, XAlert, XTextarea, XSelect, XTab, XTabGroup, XPopover;
}

const pathSolucoes = "\\media\\solucoes\\";
let querySolucoes = ref({
  q: "",
  offset: 0,
  qpag: 30,
  c: "",
});
let produtoDetalhe = ref({});
let produtoEmEdicao = ref({
  emEdicao: false,
});

onMounted(() => {
  getLinhas();
});

let tab = ref("b");

function editaSolucao(produto) {
  console.log(produto);
  if (produto.destaque == 0) {
    produto.destaque = false;
  } else {
    produto.destaque = true;
  }

  produtoEmEdicao.value = produto;
  produtoEmEdicao.value.emEdicao = true;
  produtoDetalhe.value = [];
  produtoDetalhe.value.push(produto);
}
async function getSolucoes() {
  let Qlen = querySolucoes.value.q.length;
  let Cod = querySolucoes.value.c.length;
  if (Qlen >= 3 || Cod > 0) {
    let R = await $fetch(
      "/api/formSolucoes.php",

      {
        method: "GET",
        params: querySolucoes.value,
      }
    ).then((R) => {
      if (JSON.parse(R).length > 0) {
        produtoDetalhe.value = JSON.parse(R);
      } else {
        produtoDetalhe.value = [];
        alert("Sem resultados pra pesquisa !");
      }
    });
  }
}

let q = {
ativo: "s", // s | n | t
};
async function getLinhas() {

  let L = await $fetch("/api/formSolucaoLinhas.php", {
    method: "GET",
    params: q,
  }).then((L) => {
    let soluTMP = [];
    if (JSON.parse(L).length > 0) {
      let LI = JSON.parse(L);

      LI.forEach((L) => {
        soluTMP.push({ value: L.id, label: L.titulo });
      });
    } else {
      alert("Não há Linhas cadastrados !");
    }
    solucaoLinhasOPT.value = soluTMP;
  });
}
const solucaoLinhasOPT = ref([]);

let solucoesForm = ref({
  emEdicao: false,
  titulo: "",
  codigo: "",
  linha_id: null,
  descricao: "",
  descricao_en: "",
  destaque: false,
});

//EDITA PRODUTO

let formSoluImgsEdita = new FormData();
function apendFileEdit() {
  formSoluImgsEdita = new FormData();
  let arq;
  let arqData;

  // IMAGEM BANNER BLOG
  arq = null;
  arq = document.getElementById("imagemTag-1b");
  if (arq.files[0]) {
    arqData = arq.files[0];
    formSoluImgsEdita.append("0", arqData);
  }
  arq = null;
  arq = document.getElementById("imagemTag-2b");
  if (arq.files[0]) {
    arqData = arq.files[0];
    formSoluImgsEdita.append("1", arqData);
  }
  arq = null;
  arq = document.getElementById("imagemTag-3b");
  if (arq.files[0]) {
    arqData = arq.files[0];
    formSoluImgsEdita.append("2", arqData);
  }

  // **** RETIRADO EM 30 10 2024
  // arq = null;
  // arq = document.getElementById("videoTag-1b");
  // if (arq.files[0]) {
  //   arqData = arq.files[0];
  //   formSoluImgsEdita.append("3", arqData);
  // }


  arq = null;
  arq = document.getElementById("dwgTag-1b");
  if (arq.files[0]) {
    arqData = arq.files[0];
    formSoluImgsEdita.append("4", arqData);
  }

  //ADD FORM JSON
  formSoluImgsEdita.append("json", JSON.stringify(produtoEmEdicao.value));
}
async function formRequestEdita() {
  apendFileEdit();
  document.getElementById("submitButtonEditaSoluID").disabled = "disabled";

  return await $fetch("/api/formSolucoes.php", {
    mode: "cors",
    headers: {
      boundary: "---------------------------974767299852498929531610575",
    },
    method: "POST",
    body: formSoluImgsEdita,
  }).then((R) => {
    alert(R);
    document.getElementById("submitButtonEditaSoluID").disabled = "false";
    resetProdFORMEdita(4);
  });
}
//FIM EDITA PRODUTO

// ADD PRODUTO
let formSoluImgs = new FormData();
function apendFile() {
  let arq;
  let arqData;
  formSoluImgs = new FormData();

  // IMAGEM BANNER BLOG
  arq = null;
  arq = document.getElementById("imagemTag-1");
  if (arq.files[0]) {
    arqData = arq.files[0];
    formSoluImgs.append("0", arqData);
  }
  arq = null;
  arq = document.getElementById("imagemTag-2");
  if (arq.files[0]) {
    arqData = arq.files[0];
    formSoluImgs.append("1", arqData);
  }
  arq = null;
  arq = document.getElementById("imagemTag-3");
  if (arq.files[0]) {
    arqData = arq.files[0];
    formSoluImgs.append("2", arqData);
  }

  // **** RETIRADO EM 30 10 2024
  //arq = null;
  //arq = document.getElementById("videoTag");
  //if (arq.files[0]) {
  //  arqData = arq.files[0];
  //  formSoluImgs.append("3", arqData);
  //}

  //ADD FORM JSON
  formSoluImgs.append("json", JSON.stringify(solucoesForm.value));
}
function resetProdFORM(input) {
  if (input) {
    switch (input) {
      case 1:
        document.getElementById("imagem-1").src = "";
        document.getElementById("imagemTag-1").value = "";
        break;
      case 2:
        document.getElementById("imagem-2").src = "";
        document.getElementById("imagemTag-2").value = "";
        break;
      case 3:
        document.getElementById("imagem-3").src = "";
        document.getElementById("imagemTag-3").value = "";
        break;
      case 4:
        document.getElementById("video").src = "";
        document.getElementById("videoTag").value = "";
        break;
      case 5:
        solucoesForm.value = {
          emEdicao: false,
          linha_id: null,
          titulo: "",
          codigo: "",
          descricao: "",
          descricao_en: "",
          descricao_es: "",
          destaque: false,
        };
        document.getElementById("imagem-1").src = "";
        document.getElementById("imagemTag-1").value = "";

        document.getElementById("imagem-2").src = "";
        document.getElementById("imagemTag-2").value = "";

        document.getElementById("imagem-3").src = "";
        document.getElementById("imagemTag-3").value = "";

        document.getElementById("video").src = "";
        document.getElementById("videoTag").value = "";
        document.getElementById("dwgTag-1").src = "";
        document.getElementById("dwgTag-1").value = "";
        document.getElementById("dwgTag-1b").src = "";
        document.getElementById("dwgTag-1b").value = "";
        break;
        case 6:
        document.getElementById("dwgTag-1").value = "";
        break;
      default:
        break;
    }
  }
}

function resetProdFORMEdita(input) {
  if (input) {
    switch (input) {
      case 1:
        document.getElementById("imagem-1b").src = "";
        document.getElementById("imagemTag-1b").value = "";
        break;
      case 2:
        document.getElementById("imagem-2b").src = "";
        document.getElementById("imagemTag-2b").value = "";
        break;
      case 3:
        document.getElementById("imagem-3b").src = "";
        document.getElementById("imagemTag-3b").value = "";
        break;
      case 4:
        // BOTÃO CANCELAR
        produtoEmEdicao.value = {
          emEdicao: false,
          linha_id: null,
          titulo: "",
          codigo: "",
          descricao: "",
          descricaoEN: "",
          descricaoES: "",
        };
        document.getElementById("imagem-1b").src = "";
        document.getElementById("imagemTag-1b").value = "";

        document.getElementById("imagem-2b").src = "";
        document.getElementById("imagemTag-2b").value = "";

        document.getElementById("imagem-3b").src = "";
        document.getElementById("imagemTag-3b").value = "";

       // document.getElementById("imagemTag-1b").src = "";
       // document.getElementById("imagem-1b").value = "";

        document.getElementById("dwgTag-1").value = "";
        document.getElementById("dwgTag-1b").value = "";

        getSolucoes();
        break;

      default:
        break;
    }
  }
}
async function formRequest() {
  apendFile();
  document.getElementById("submitButtonAddSoluID").disabled = "disabled";
  return await $fetch("/api/formSolucoes.php", {
    mode: "cors",
    headers: {
      boundary:
        "---------------------------" +
        Math.floor(Math.random() * 16).toString(16),
    },
    method: "POST",
    body: formSoluImgs,
  }).then((R) => {
    alert(R);
    document.getElementById("submitButtonAddSoluID").disabled = "false";
    resetProdFORM(5);
  });
}

const formCsvValido = ref(false);
const solucaoCsv = ref([]);
const formArquivoTXT = ref({
  exe: "",
  linha_id: null
});

function formataDescicao(Array){
  Array.map((A,i)=>{
    Array[i][4] = A[4].split('#');
    Array[i][5] = A[5].split('#');
    Array[i][6] = A[6].split('#');

  })
return Array;
}
async function formRequestCsv(exe) {
  let formSoluCsv = new FormData();
  let arq;
  let arqData;
  arq = document.getElementById("arquivotxtID");

  if (formCsvValido.value == false) {
    formArquivoTXT.value.exe = "validar";
  } else {
    formArquivoTXT.value.exe = "salvar";
  }

  formSoluCsv.append("json", JSON.stringify(formArquivoTXT.value));

  if (arq.files[0]) {
    arqData = arq.files[0];
    formSoluCsv.append("0", arqData);
  }else{
    alert("Não há arquivo TXT");
    return;
  }

  return await $fetch("/api/formSolucoesCsv.php", {
    mode: "cors",
    headers: {
      boundary:
        "---------------------------" +
        Math.floor(Math.random() * 16).toString(16),
    },
    method: "POST",
    body: formSoluCsv,
  }).then((R) => {

    const r = JSON.parse(R);
    if(r.codigo == 1){
      alert(r.msg);
      return;
    }
    

    formCsvValido.value = true;
    if(formArquivoTXT.value.exe == "salvar"){
      alert(r.msg);
      resetFormCsv();
      formCsvValido.value = false;
    }else{
      solucaoCsv.value = formataDescicao(r.dados);
      console.log(solucaoCsv.value);
    }
  });
}
function resetFormCsv() {
  document.getElementById("arquivotxtID").value = null;
  formArquivoTXT.value.exe = "";
  formCsvValido.value = false;
  solucaoCsv.value = [];
}
</script>

<style scoped>
.slides {
  display: flex;
  --overflow-x: hidden;
  overflow-y: hidden;
  scroll-snap-type: x mandatory;
  scroll-behavior: smooth;
  -webkit-overflow-scrolling: touch;
}
.slide {
  scroll-snap-align: center;
  flex-shrink: 0;
  transition: 1s;
  position: relative;
  display: flex;
  justify-content: center;
  align-items: center;
}
.slides input {
  display: none;
}
.radioAtivo {
  width: 48px !important;
  background-color: #74df43 !important;
}
#radioDestq0:checked ~ .first {
  margin-left: 0px;
}
#radioDestq1:checked ~ .first {
  margin-left: -100%;
}
#radioDestq2:checked ~ .first {
  margin-left: -200%;
}
.manual-nav {
  display: flex;
  justify-content: center;
}
.manual-bt-destaque {
  cursor: pointer;
  transition: 1s;
  width: 16px;
  height: 16px;
  border-radius: 16px;
  background-color: #ffffff;
}
.manual-bt-destaque:hover {
  background-color: #74df43;
}
</style>