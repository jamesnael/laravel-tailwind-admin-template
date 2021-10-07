<template>
  <a v-if="hasAccess(menu.access, $page.props.currentUser.jabatan.hak_akses)" href="javascript:;" :class="{ 'h-12 flex items-center pl-5 mb-1 relative rounded-full': true, 'text-white bg-dark-1': menu.active, 'text-gray-300 hover:bg-dark-2 hover:text-gray-200': !menu.active }" @click.prevent="openMenu = !openMenu">
      <slot :name="'icon-menu-' + menu.uniqid">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
          <path d="M9.669.864 8 0 6.331.864l-1.858.282-.842 1.68-1.337 1.32L2.6 6l-.306 1.854 1.337 1.32.842 1.68 1.858.282L8 12l1.669-.864 1.858-.282.842-1.68 1.337-1.32L13.4 6l.306-1.854-1.337-1.32-.842-1.68L9.669.864zm1.196 1.193.684 1.365 1.086 1.072L12.387 6l.248 1.506-1.086 1.072-.684 1.365-1.51.229L8 10.874l-1.355-.702-1.51-.229-.684-1.365-1.086-1.072L3.614 6l-.25-1.506 1.087-1.072.684-1.365 1.51-.229L8 1.126l1.356.702 1.509.229z"/>
          <path d="M4 11.794V16l4-1 4 1v-4.206l-2.018.306L8 13.126 6.018 12.1 4 11.794z"/>
        </svg>
      </slot>
      <div class="w-full ml-3 flex items-center">
          {{ menu.text }} 
          <transition-rotate v-if="openMenu" from="180" to="0" class="ml-auto mr-5 transform rotate-180">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="w-4 h-4 transform rotate-180" viewBox="0 0 16 16">
              <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
            </svg>
          </transition-rotate>
          <transition-rotate v-else from="0" to="180" class="ml-auto mr-5">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="w-4 h-4" viewBox="0 0 16 16">
              <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
            </svg>
          </transition-rotate>
      </div>
  </a>
  <TransitionSlide :show="openMenu">
    <ul class="rounded-md bg-dark-2">
        <li v-for="submenu in menu.children">
            <Link v-if="hasAccess(submenu.access, $page.props.currentUser.jabatan.hak_akses)" :href="submenu.route === '#' ? '#' : route(submenu.route)" :class="{ 'h-12 flex items-center pl-5 mb-1 relative rounded-full': true, 'text-white': submenu.active, 'text-gray-300': !submenu.active }">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="w-2 h-2" viewBox="0 0 16 16">
                  <circle cx="8" cy="8" r="8"/>
                </svg>
                <div class="w-full ml-3 flex items-center"> {{ submenu.text }} </div>
            </Link>
        </li>
    </ul>
  </TransitionSlide>
</template>

<script>
  import { ref, onMounted } from "vue";
  import { usePage, Link } from '@inertiajs/inertia-vue3';
  import TransitionSlide from "@/Transitions/Slide.vue";
  import TransitionRotate from "@/Transitions/Rotate.vue";

  export default {
    name: 'SubMenu',
    components: {
      Link,
      TransitionSlide,
      TransitionRotate
    },
    props: {
      menu: {
        type: Object,
      }
    },
    setup(props) {
      let openMenu = ref(false)

      onMounted(() => { openMenu.value = props.menu.open })

      return {
        openMenu,
      }
    }
  }
</script>