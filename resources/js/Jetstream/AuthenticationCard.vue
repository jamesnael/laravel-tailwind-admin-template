<template>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
        <div class="flex flex-row w-full sm:max-w-md items-center justify-between">
            <slot name="logo" />
        	<slot name="title">
	            <span class="font-extrabold">Masuk ke Admin Panel</span>
        	</slot>
        </div>

        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            <slot />
        </div>

        <small class="mt-5">{{ new Date().getFullYear() }} &copy; PT Bintang Ezella Sejahtera. All Rights Reserved.</small>
    </div>
</template>
