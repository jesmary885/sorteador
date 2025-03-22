<div>

  <div class="flex items-center justify-center pt-10 bg-gray-100">
    <div class="container">
      <div class="bg-white rounded-lg shadow-lg p-5 md:p-20 mx-2">
        <div class="text-center">
          <h2 class="text-4xl tracking-tight leading-10 font-extrabold text-gray-900 sm:text-5xl sm:leading-none md:text-6xl">
            Sorteador<span class="text-indigo-600">Sp2</span>
          </h2>
          <h3 class='text-xl md:text-3xl mt-10'>Bienvenido</h3>
          <p class="text-md md:text-xl mt-10"> Solo haz click en el botón "GENERAR", una vez culmine el sorteo haga click en el botón "FINALIZAR"</p>
        </div>
        <div class="flex flex-wrap mt-10 justify-center">
          <button wire:click="generar()" class="bg-blue-500 text-white font-bold w-48 h-48 rounded-full hover:bg-blue-700 transition duration-300 flex items-center justify-center text-xl">
            GENERAR
          </button>

          @if($iniciado == 1)

            <button wire:click="finalizar()" class="bg-red-500 ml-4 text-white font-bold w-48 h-48 rounded-full hover:bg-red-700 transition duration-300 flex items-center justify-center text-xl">
              FINALIZAR
            </button>

          @endif
        </div>

        @if($iniciado == 1)

        <div class="w-full flex  justify-center  mt-12 mb-6 ">
            <div class="flex items-center flex-wrap w-full lg:w-1/4 px-10 bg-white shadow-xl rounded-2xl h-20"
              x-data="{ circumference: 50 * 2 * Math.PI, percent: 100 }"
              >
              <div class="flex items-center justify-center -m-6 overflow-hidden bg-white rounded-full">
                <svg class="w-32 h-32 transform translate-x-1 translate-y-1" x-cloak aria-hidden="true">
                  <circle
                    class="text-gray-300"
                    stroke-width="10"
                    stroke="currentColor"
                    fill="transparent"
                    r="50"
                    cx="60"
                    cy="60"
                    />
                  <circle
                    class="text-blue-600"
                    stroke-width="10"
                    :stroke-dasharray="circumference"
                    :stroke-dashoffset="circumference - percent / 100 * circumference"
                    stroke-linecap="round"
                    stroke="currentColor"
                    fill="transparent"
                    r="50"
                    cx="60"
                    cy="60"
                  />
                </svg>
                <span class="absolute text-2xl text-blue-700 font-bold"> {{$letra}}</span>
              </div>
          

            <span class="ml-auto text-2xl font-bold text-blue-600   ">{{$numero}}</span>
          </div>
        </div>

      @endif
      </div>
    </div>
  </div>
</div>
