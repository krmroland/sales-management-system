<template>
	<div class="form-group" :class="rowClass">
		<div>
			<!-- number fields -->
			<template v-if="fieldType(field) == 'number'">
				<label>{{field.name|title}}</label>
				<input type="number"
				:name="field.name"
				v-model="form[field.name]" 
				class="form-control"  
				:step="field.step"
				:placeholder="field.label|capitalize" >
			</template>
			<!-- text fields -->
			<template v-else-if="fieldType(field) == 'text'">
				<label>{{field.name|title}}</label>
				<input 
				type="text" 
				:name="field.name"
				v-model="form[field.name]" 
				class="form-control" 
				:placeholder="field.label|capitalize"
				:disabled="field.disabled" 
				 >
			</template>
			<!-- select boxes -->
			<template v-else-if="fieldType(field) == 'select'">
				<label>{{field.label|title}}</label>
				<select class="form-control" 
				v-model="form[field.name]"
				:name="field.name"
				@change="form.errors.clear(field.name)"
				>
				<option value="" disabled="">Choose ..........</option>
				<template v-for="(option,key) in field.options">
					<option :value="field.hasKeys?key:option">{{option|capitalize}}</option>
				</template>
			</select>
		</template>
		<!-- radios -->
		<template v-else-if="fieldType(field) == 'radio'">

			<div>
				<label>{{field.label|title}}</label>
			</div>

			<span v-for="(option,key) in field.options">
				<label class="custom-control custom-radio">
					<input id="radio1" :name="field.name" type="radio" class="custom-control-input" :value="key" v-model="form[field.name]">
					<span class="custom-control-indicator"></span>
					<span class="custom-control-description">
						<span v-html="option"></span>
					</span>
				</label>
			</span>
			
		</template>

		<!-- dates -->
		<template v-else-if="fieldType(field) == 'date'">
			<date :label="field.label" @dateChanged="form[field.name]=$event"></date>
		</template>

		


	</div>
	<zoom>
		<p class="form-text text-danger" v-if="form.errors.has(field.name)">
			{{form.errors.get(field.name)}}
		</p>
	</zoom>
</div>
</template>
<script>
import date from "../components/date";
	export default {

		components:{date},

		props:["field","form","rowClass"],

		data()
		{
			return {

			}
		},

		methods:{

			fieldType(field)
			{
				if (field.hasOwnProperty("type")) {
					return field['type'];
				}

				if (field.hasOwnProperty("min")|| field.hasOwnProperty("max")) {
					return "number";
				}
				if (field.hasOwnProperty("options")) {
					return "select";
				}
				return "text";
			}
		}

	}
</script>