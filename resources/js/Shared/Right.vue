<template>
    <div>
        <!-- Right -->
        <div class="hidden md:block w-290 lg:w-350 h-screen">
          <div
            class="flex flex-col fixed overflow-y-auto w-290 lg:w-350 h-screen"
          >
            <!-- Search -->
            <div class="relative m-2">
              <div
                class="absolute text-gray-600 flex items-center pl-4 h-full cursor-pointer"
              >
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  class="icon icon-tabler icon-tabler-mail"
                  width="18"
                  height="18"
                  viewBox="0 0 24 24"
                  stroke-width="1.5"
                  stroke="currentColor"
                  fill="none"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                >
                  <path
                    d="M21.53 20.47l-3.66-3.66C19.195 15.24 20 13.214 20 11c0-4.97-4.03-9-9-9s-9 4.03-9 9 4.03 9 9 9c2.215 0 4.24-.804 5.808-2.13l3.66 3.66c.147.146.34.22.53.22s.385-.073.53-.22c.295-.293.295-.767.002-1.06zM3.5 11c0-4.135 3.365-7.5 7.5-7.5s7.5 3.365 7.5 7.5-3.365 7.5-7.5 7.5-7.5-3.365-7.5-7.5z"
                  ></path>
                </svg>
              </div>
              <input
                class="w-full bg-gray-200 dark:bg-dim-400 border-gray-200 dark:border-dim-400 text-gray-100 focus:bg-gray-100 dark:focus:bg-dim-900 focus:outline-none focus:border focus:border-blue-200 font-normal h-9 flex items-center pl-12 text-sm rounded-full border shadow"
                placeholder="Search Birb"
              />
            </div>
            <!-- /Search -->

            <!-- What’s happening -->
            <div class="bg-gray-50 dark:bg-dim-700 rounded-2xl m-2">
              <h1
                class="text-gray-900 dark:text-white text-md font-bold p-3 border-b border-gray-200 dark:border-dim-200"
              >
                What’s happening
              </h1>

              <!-- Trending Topic -->
              <div
                class="text-blue-400 text-sm font-normal p-3 border-b border-gray-200 dark:border-dim-200 hover:bg-gray-100 dark:hover:bg-dim-300 cursor-pointer transition duration-350 ease-in-out"
              >
                <h2 class="font-bold text-md text-gray-800 dark:text-white">
                  #LOL
                </h2>
                <p class="text-xs text-gray-400">29.7K Posts</p>
              </div>
              <!-- /Trending Topic -->

              <!-- Trending Topic -->
              <div
                class="text-blue-400 text-sm font-normal p-3 border-b border-gray-200 dark:border-dim-200 hover:bg-gray-100 dark:hover:bg-dim-300 cursor-pointer transition duration-350 ease-in-out"
              >
                <h2 class="font-bold text-md text-gray-800 dark:text-white">
                  #cats
                </h2>
                <p class="text-xs text-gray-400">351K Posts</p>
              </div>
              <!-- /Trending Topic -->

              <!-- Trending Topic -->
              <div
                class="text-blue-400 text-sm font-normal p-3 border-b border-gray-200 dark:border-dim-200 hover:bg-gray-100 dark:hover:bg-dim-300 cursor-pointer transition duration-350 ease-in-out"
              >
                <h2 class="font-bold text-md text-gray-800 dark:text-white">
                  #FOSS
                </h2>
                <p class="text-xs text-gray-400">52.7K Posts</p>
              </div>
              <!-- /Trending Topic -->

              <div
                class="text-blue-400 text-sm font-normal p-3 hover:bg-gray-100 dark:hover:bg-dim-300 cursor-pointer transition duration-350 ease-in-out"
              >
                Show more
              </div>
            </div>
            <!-- /What’s happening -->

            <!-- Who to follow -->
            <div class="bg-gray-50 dark:bg-dim-700 rounded-2xl m-2">
              <h1
                class="text-gray-900 dark:text-white text-md font-bold p-3 border-b border-gray-200 dark:border-dim-200"
              >
                Who to follow
              </h1>

              <!-- Twitter Account -->
              <div
                class="text-blue-400 text-sm font-normal p-3 border-b border-gray-200 dark:border-dim-200 hover:bg-gray-100 dark:hover:bg-dim-300 cursor-pointer transition duration-350 ease-in-out"
              >
                <div class="flex flex-row justify-between p-2">
                  <div class="flex flex-row">
                    <img
                      class="w-10 h-10 rounded-full"
                      src="https://catgram.co/storage/avatars/044/132/214/635/043/225/7/PTAnQfoaB76CJ0a3Qusn_avatar.jpg"
                      alt="Washy"
                    />
                    <div class="flex flex-col ml-2">
                      <h1
                        class="text-gray-900 dark:text-white font-bold text-sm"
                      >
                        Washy
                      </h1>
                      <p class="text-gray-400 text-sm">@Washy</p>
                    </div>
                  </div>
                  <div class="">
                    <div
                      class="flex items-center h-full text-gray-800 dark:text-white"
                    >
                      <a
                        href="#"
                        class="text-xs font-bold text-blue-400 px-4 py-1 rounded-full border-2 border-blue-400"
                        >Follow</a
                      >
                    </div>
                  </div>
                </div>
              </div>
              <!-- /Twitter Account -->

              <!-- Twitter Account -->
              <div
                class="text-blue-400 text-sm font-normal p-3 border-b border-gray-200 dark:border-dim-200 hover:bg-gray-100 dark:hover:bg-dim-300 cursor-pointer transition duration-350 ease-in-out"
              >
                <div class="flex flex-row justify-between p-2">
                  <div class="flex flex-row">
                    <img
                      class="w-10 h-10 rounded-full"
                      src="https://catgram.co/storage/avatars/044/132/266/233/773/260/9/GkTungHuj3Xeo0Wp9kH0_avatar.jpg?v=2"
                      alt="George"
                    />
                    <div class="flex flex-col ml-2">
                      <h1
                        class="text-gray-900 dark:text-white font-bold text-sm"
                      >
                        George
                      </h1>
                      <p class="text-gray-400 text-sm">@George</p>
                    </div>
                  </div>
                  <div class="">
                    <div
                      class="flex items-center h-full text-gray-800 dark:text-white"
                    >
                      <a
                        href="#"
                        class="text-xs font-bold text-blue-400 px-4 py-1 rounded-full border-2 border-blue-400"
                        >Follow</a
                      >
                    </div>
                  </div>
                </div>
              </div>
              <!-- /Twitter Account -->

            

              <div
                class="text-blue-400 text-sm font-normal p-3 hover:bg-gray-100 dark:hover:bg-dim-300 cursor-pointer transition duration-350 ease-in-out"
              >
                Show more
              </div>
            </div>
            <!-- /Who to follow -->

            <footer>
              <ul class="text-xs text-gray-500 my-4 mx-2">
                <li class="inline-block mx-2">
                  <a class="hover:underline" href="#">Terms of Service</a>
                </li>
                <li class="inline-block mx-2">
                  <a class="hover:underline" href="#">Privacy Policy</a>
                </li>
                <li class="inline-block mx-2">
                  <a class="hover:underline" href="#">Cookie Policy</a>
                </li>
                
                <li class="inline-block mx-2">© 2022 Birb, Inc.</li>
              </ul>
            </footer>
          </div>
        </div>
        <!-- /Right -->
    </div>
</template>
<script>
export default {
    
}
</script>
<style lang="">
    
</style>