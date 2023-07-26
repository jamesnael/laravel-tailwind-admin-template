<template>
	<form>
		<div class="flex flex-col space-y-4">
			<table class="table-fixed border-collapse border border-gray-200 shadow mt-4">
			  <thead>
				<tr class="bg-gray-50">
				  <th class="p-4">User Name</th>
				  <th class="p-4">Group User</th>
				  <th class="p-4">Activity</th>
				  <th class="p-4">Date</th>
				</tr>
			  </thead>
			  <tbody class="bg-white">
				<tr class="whitespace-nowrap">
				  <td class="p-4" align="center">{{ form.nama_user }}</td>
				  <td class="p-4" align="center">{{ form.nama_jabatan }}</td>
				  <td class="p-4" align="center">{{ form.aktivitas }}</td>
				  <td class="p-4" align="center">{{ form.tanggal }}</td>
				</tr>
			  </tbody>
			</table>

			<div v-if="form.detail.length > 0 || Object.keys(form.detail).length > 0" class="pt-8">
				<span class="text-lg font-medium">Detail Data</span>
				<table class="table-auto border-collapse border border-gray-400 mt-4 w-full">
				  <tbody>
					<tr v-for="(element, index) in form.detail">
					  <td class="border border-gray-300 p-4" align="left" width="30%" v-if="showNotId(index) && element" style="text-transform: capitalize;">{{ changeFormatKey(index) }}</td>
					  <td class="border border-gray-300 p-4" align="center" width="10%" v-if="showNotId(index) && element">:</td>
					  <td class="border border-gray-300 p-4" align="center" width="60%" v-if="showNotId(index) && element">{{ element }}</td>
					</tr>
				  </tbody>
				</table>
			</div>

			<div v-if="form.changes.length > 0 || Object.keys(form.changes).length > 0" class="pt-8">
				<span class="text-lg font-medium">Perubahan Data</span>
				<table class="table-auto border-collapse border border-gray-400 mt-4 w-full">
				  <tbody>
					<tr v-for="(element, index) in form.changes">
					  <td class="border border-gray-300 p-4" align="left" width="30%" v-if="showNotId(index) && element" style="text-transform: capitalize;">{{ changeFormatKey(index) }}</td>
					  <td class="border border-gray-300 p-4" align="center" width="10%" v-if="showNotId(index) && element">:</td>
					  <td class="border border-gray-300 p-4" align="center" width="60%" v-if="showNotId(index) && element">{{ element }}</td>
					</tr>
				  </tbody>
				</table>
			</div>

			<div class="flex flex-row justify-end space-x-4 pt-5">
				<a :href="route('admin.log-activity.index')" class="py-3 px-6 text-center shadow-md rounded-md font-semibold text-white bg-gray-400 focus:outline-none focus:ring-4 focus:ring-gray-300 disabled:cursor-not-allowed">
					Back
				</a>
			</div>
		</div>
	</form>
</template>

<script>
	import { onMounted } from 'vue';
	import { useForm } from '@inertiajs/inertia-vue3';

	export default {
		name: 'LogActivityForm',
		components: {},
		props: {
			httpMethod: {
				type: String,
				default: () => 'post',
				validator(value) {
					return ['get', 'post', 'put', 'patch', 'delete'].includes(value);
				}
			},
			actionUri: {
				type: String,
				default: () => ''
			},
			logActivity: {
			  type: Object,
			  default: () => null
			},
		},
		methods:{
			showNotId(key) {
				return (!_.includes(key, '_at') && key != 'id' && !_.includes(key, '_by') && key != 'slug');
			},
			changeFormatKey(key) {
				return key.replace(/_/g, ' ');
			}
		},
		setup (props) {
			const form = useForm({
				nama_user: '',
				nama_jabatan: '',
				nama_regional: '',
				aktivitas: '',
				tanggal: '',
				properties: [],
				changes: [],
				detail: [],
			})
			onMounted(() => {
				if (props.logActivity) {
					form.nama_user = props.logActivity.causer.nama_lengkap;
					form.nama_jabatan = props.logActivity.causer.jabatan.nama_jabatan;
					form.nama_regional = props.logActivity.causer.regional ? props.logActivity.causer.regional.nama_regional : '-';
					form.aktivitas = props.logActivity.description;
					form.properties = props.logActivity.properties[0];
					form.tanggal = props.logActivity.created_date;
					form.changes = form.properties['changes'];
					form.detail = form.properties['attributes'];
				}
			})
			return {
				form,
		  }
		}
  }
</script>