<template>
    <div>
        <notification :toast="$page.props.toast" :popstate="$page.props.popstate" />
        <div class="min-h-screen bg-gray-200">
            <nav class="bg-sky-500  fixed top-0 right-0 left-0 z-50">
                <!-- Primary Navigation Menu -->
                <div class="max-w-7xl  mx-auto  px-6 sm:px-12">
                    <div class="flex justify-between h-14">
                            <!-- Logo -->
                            <div class="flex-shrink-0 flex items-center">
                                <Link :href="route('dashboard')">
                                   <h1 class=" font-black text-xl text-sky-100">{{$page.props.university.name}}</h1>
                                </Link>
                            </div>
                        <div class="flex">

                            <!-- Navigation Links -->
                            <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex ">
                                <BreezeNavLink :href="route('dashboard')" :active="route().current('dashboard')" >
                                    Dashboard
                                </BreezeNavLink>
                                <BreezeNavLink :href="route('report.index')" :active="route().current('report.*')">
                                    Reports
                                </BreezeNavLink>
                                <BreezeNavLink :href="route('employee.index')" :active="route().current('employee.*')">
                                    Employee
                                </BreezeNavLink>
                                <BreezeNavLink :href="route('faculty.index', 1)" :active="route().current('faculty.*')">
                                    Faculty
                                </BreezeNavLink>
                            </div>
                        </div>

                        <div class="hidden sm:flex sm:items-center sm:ml-6 ">
                            <!-- Settings Dropdown -->
                            <div class="ml-3 relative ">
                                <BreezeDropdown align="right" width="48">
                                    <template #trigger>
                                        <span class="inline-flex rounded-md ">
                                            <button type="button" class="bg-sky-100 inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500  hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                                {{ $page.props.auth.user.name }}

                                                <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                                </svg>
                                            </button>
                                        </span>
                                    </template>

                                    <template #content>
                                        <BreezeDropdownLink :href="route('setting')" method="get" as="button" class="border-b">
                                            Settings
                                        </BreezeDropdownLink>
                                        <BreezeDropdownLink :href="route('logout')" method="post" as="button">
                                            Log Out
                                        </BreezeDropdownLink>
                                    </template>
                                </BreezeDropdown>
                            </div>
                        </div>

                        <!-- Hamburger -->
                        <div class="-mr-2 flex items-center sm:hidden">
                            <button @click="showingNavigationDropdown = ! showingNavigationDropdown" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                    <path :class="{'hidden': showingNavigationDropdown, 'inline-flex': ! showingNavigationDropdown }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                    <path :class="{'hidden': ! showingNavigationDropdown, 'inline-flex': showingNavigationDropdown }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Responsive Navigation Menu -->
                <div :class="{'block': showingNavigationDropdown, 'hidden': ! showingNavigationDropdown}" class="sm:hidden">
                    <div class="pt-2 pb-3 space-y-1">
                        <BreezeResponsiveNavLink :href="route('dashboard')" :active="route().current('dashboard')">
                            Dashboard
                        </BreezeResponsiveNavLink>
                        <BreezeResponsiveNavLink :href="route('report.index')" :active="route().current('report.*')">
                            Reports
                        </BreezeResponsiveNavLink>
                        <BreezeResponsiveNavLink :href="route('employee.index')" :active="route().current('employee.*')">
                            Employee
                        </BreezeResponsiveNavLink>
                        <BreezeResponsiveNavLink :href="route('faculty.index', 1)" :active="route().current('faculty.*')">
                            Faculty
                        </BreezeResponsiveNavLink>
                    </div>

                    <!-- Responsive Settings Options -->
                    <div class="pt-4 pb-1 border-t border-sky-200">
                        <div class="px-4">
                            <div class="font-medium text-base text-gray-800">{{ $page.props.auth.user.name }}</div>
                            <div class="font-medium text-sm text-gray-500">{{ $page.props.auth.user.email }}</div>
                        </div>

                        <div class="mt-3 space-y-1">
                            <BreezeResponsiveNavLink :href="route('logout')" method="post" as="button">
                                Log Out
                            </BreezeResponsiveNavLink>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Page Heading -->
            

            <!-- Page Content -->
            <main class="mt-14 pt-1">
                <slot />
            </main>

            <footer class="h-12 w-full text-white bg-sky-500 py-3">
                <div class="flex max-w-2xl mx-auto justify-between">
                    <div class="px-2">
                         	&#169; Copyright {{year}} |  
                            <a href="https://opensource.org/licenses/MIT">
                                MIT License
                            </a>
                    </div>
                    <div class=""> Designed &amp; Developed by
                        <a href="https://twitter.com/ObaidGhawsi" class="underline" target="blank">
                            Obaidullah Ghawsi
                        </a>
                    </div>
                </div>
            </footer>
        </div>
    </div>
</template>

<script>
import BreezeApplicationLogo from '@/Components/ApplicationLogo.vue'
import BreezeDropdown from '@/Components/Dropdown.vue'
import Notification from '@/Components/Notification.vue'
import BreezeDropdownLink from '@/Components/DropdownLink.vue'
import BreezeNavLink from '@/Components/NavLink.vue'
import BreezeResponsiveNavLink from '@/Components/ResponsiveNavLink.vue'
import { Link } from '@inertiajs/inertia-vue3';

export default {
    components: {
        Notification,
        BreezeApplicationLogo,
        BreezeDropdown,
        BreezeDropdownLink,
        BreezeNavLink,
        BreezeResponsiveNavLink,
        Link,
    },
    
    data() {
        return {
            showingNavigationDropdown: false,
            year: new Date().getFullYear(),
        }
    },
}
</script>
