    <template>
    <div class="mb-6">
        <!-- title and button -->
        <div class="flex justify-between">
            <span class="text-lg font-bold tracking-wide">Address & Contact Info</span>
            <add-new-button :href="route('address.create', employee.id)" />
        </div>
        <!-- table to show data -->
        <div v-if="!addresses[0]" class="border-2 rounded-lg mt-3 border-dashed border-sky-500 px-6 py-3"> 
            <add-new-button :href="route('address.create', employee.id)" />
        </div>

        <div v-else class="flex flex-col border-t-3 border-sky-500">
            <div>
                <table class="w-full whitespace-nowrap">
                    <tr class="text-sm text-left text-sky-800 font-semibold bg-sky-100">
                        <th class="px-6 py-2">Province</th>
                        <th class="px-6 py-2">Address Type</th> 
                        <th class="px-6 py-2">Street Address</th>
                        <th class="px-6 py-2"></th>
                    </tr>
                    <tr class="text-sm hover:bg-gray-100 focus-within:bg-gray-100" v-for="(address, index) in addresses" :key="index">
                        <td class="border-t px-6 py-2">
                            <Link :href="route('address.edit', address.id)" class=" focus:text-indigo-500"> {{address.province_english}} </Link>
                        </td>
                        <td class="border-t px-6 py-2">
                            <Link :href="route('address.edit', address.id)" class=" focus:text-indigo-500">
                                <div v-if="address.address_type === 1"> Current </div>
                            <div v-if="address.address_type === 2"> Permanent </div>
                                </Link>
                        </td>
                        <td class="border-t px-6 py-2">
                            <Link :href="route('address.edit', address.id)" class=" focus:text-indigo-500"> {{address.street_address_english}} </Link>
                        </td>
                        <td class="border-t">
                            <Link :href="route('address.edit', address.id)" class="px-4 flex items-center" tabindex="-1">
                                <icon name="chavron-right" class="h-5 w-5 text-gray-400" />
                            </Link>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
import AddNewButton from '@/Components/AddNewButton.vue';
import { Link } from '@inertiajs/inertia-vue3';
export default {
    components: {
        AddNewButton,
        Link,
    },
    props: {
        addresses: Object,
        employee: Object,
    },
}
</script>