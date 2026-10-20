
<script setup>
import { ref } from 'vue';
import { Link, usePage } from '@inertiajs/vue3';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';

const showingNavigationDropdown = ref(false);
const showingUserDropdown = ref(false);

const page = usePage();

const user = page.props.auth?.user;

const logout = () => {
    // Logout ditangani oleh route Laravel
    import('@inertiajs/vue3').then(({ router }) => {
        router.post(route('logout'));
    });
};
</script>

<template>
    <div class="min-h-screen bg-gray-100">
        <!-- Sidebar -->
        <div class="flex min-h-screen">
            <aside class="flex w-64 shrink-0 flex-col bg-gray-800 text-white">
                <div class="border-b border-gray-700 px-5 py-6">
                    <Link href="/books" class="text-xl font-bold">
                        Perpustakaan Mini
                    </Link>
                </div>

                <nav class="flex-1 space-y-2 px-3 py-5">
                    <Link
                        href="/dashboard"
                        class="block rounded-md px-4 py-3 transition hover:bg-gray-700"
                        :class="{ 'bg-gray-700': $page.url.startsWith('/dashboard') }"
                    >
                        Dashboard
                    </Link>

                    <Link
                        href="/"
                        class="block rounded-md px-4 py-3 transition hover:bg-gray-700"
                        :class="{ 'bg-gray-700': $page.url === '/' }"
                    >
                        Beranda
                    </Link>

                    <Link
                        href="/books"
                        class="block rounded-md px-4 py-3 transition hover:bg-gray-700"
                        :class="{ 'bg-gray-700': $page.url.startsWith('/books') }"
                    >
                        Data Buku
                    </Link>
                </nav>

                <div class="border-t border-gray-700 px-5 py-4 text-sm text-gray-300">
                    Sistem Informasi Perpustakaan
                </div>
            </aside>

            <!-- Konten utama -->
            <div class="flex min-w-0 flex-1 flex-col">
                <!-- Navbar -->
                <header class="flex h-20 items-center justify-between border-b border-gray-200 bg-white px-6 shadow-sm">
                    <div class="flex items-center gap-3">
                        <ApplicationLogo class="h-9 w-9 fill-current text-gray-600" />
                        <span class="font-medium text-gray-700">
                            Dashboard
                        </span>
                    </div>

                    <div class="relative">
                        <button
                            type="button"
                            @click="showingUserDropdown = !showingUserDropdown"
                            class="flex items-center gap-2 rounded-md px-3 py-2 text-gray-700 hover:bg-gray-100"
                        >
                            <span>{{ user?.name ?? 'Pengguna' }}</span>
                            <span>⌄</span>
                        </button>

                        <div
                            v-if="showingUserDropdown"
                            class="absolute right-0 z-50 mt-2 w-48 rounded-md border border-gray-200 bg-white py-2 shadow-lg"
                        >
                            <Link
                                href="/profile"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                            >
                                Profil
                            </Link>

                            <button
                                type="button"
                                @click="logout"
                                class="block w-full px-4 py-2 text-left text-sm text-red-600 hover:bg-gray-100"
                            >
                                Keluar
                            </button>
                        </div>
                    </div>
                </header>

                <!-- Isi halaman -->
                <main class="min-w-0 flex-1 p-6">
                    <slot />
                </main>
            </div>
        </div>
    </div>
</template>
