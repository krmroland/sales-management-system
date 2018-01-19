<template>
	<div>
		<!-- the main item wrapper -->
		<div class="form-group" :class="icon.group">
			<!-- the search lalbel -->
			<label class="font-italic h5" v-text="label"></label>
			<!-- input group begins here -->
			<div class="input-group">
				<!-- the input  -->
				<input type="text" 
				class="form-control" 
				:value="query" @input="updateInput($event.target.value)"
				:class="icon.input"
				placeholder="Type to begin searching"

				/>
				<div class="input-group-addon text-white bg-primary" v-if="isInitial || isSearching">
					<!-- input addon -->
					<span class="d-flex align-items-center">
						<i :class="icon.addon"></i>
						<span v-if="isSearching" class="ml-2">Processing Search</span>
					</span>
				</div>
			</div>

			<zoom>
				<div class="alert alert-danger h6" v-if="emptySearch">
					No results matched {{this.query}}
				</div>
			</zoom>

			<zoom>
				<div v-if="results && hasDropDown" >
					<div class="list-group" v-for="result in results">
						<a href="#" class="list-group-item list-group-item-action" @click="dispatchItem(result)">
							<span v-for="attribute in attributes" class="h6">
								<span v-html="makeAttribute(result,attribute)" :class="attribute.css"></span>
							</span>
						</a>
					</div>

				</div>
			</zoom>
		</div>
		<slot></slot>

	</div>
</template>

<script>
	export default
	{
		props:{
			label:{
				default:"Type to search"
			},
			endPoint:{
				required:true,
			},
			hasDropDown:{
				default:true
			}


		},
		
		/**
		 * The central data object
		 *
		 * @return     {Object}
		 */
		 data(){
		 	return {
		 		query:null,
		 		results:null,
		 		attributes:[],
		 		isSearching:false,
		 		emptySearch:false,
		 		selected:null,
		 	}
		 },
		 /**
		  * hook into the process of when this model is being created and fetch the children
		  */
		  created()
		  {
		  	events.$on("selector:update",result=>{
		  		return this.externalUpdate(result);
		  	});

		  	this.attributes=this.$children;

		  	
		  },
		 methods:{

			/**
			 * updates the query with the input values
			 *
			 * @param      {string}  query  the typed in value
			 */
			 updateInput(query)
			 {
			 	query=query?query.trim():null;
			 	
			 	this.query=query;


			 	this.results=null;
			 	this.emptySearch=false;
			 	this.clearSelected();
			 	if (query) {
			 		this.isSearching=true;

			 		
			 		this.searchItems();
			 	}
			 	
			 },
			/**
			 * make an http request and fetch the results based on the end point given to us
			 */
			 searchItems:_.debounce(function(){

			 	axios.get(this.url).then(({data})=>{
			 		this.updateResults(data);
			 	}).catch(error=>{
			 		this.isSearching=false;
			 		this.emptySearch=true;
			 	});
			 },500),

			 clearSelected()
			 {
			 	if (!this.hasDropDown) {
			 		this.$emit("unSelected");
			 		return;
			 	}
			 	if (this.selected) {
			 		this.selected=null;
			 		this.$emit("unSelected");
			 	}
			 },

			 /**
			  * update the results and other related properties after axaj
			  *
			  * @param      {mxied}  results  
			  */
			  updateResults(results)
			  {

			  	this.isSearching=false;

			  	this.$emit("results",results);

			  	if (_.isEmpty(results)) {
			  		this.emptySearch=true;
			  		return ;
			  	}

			  	if (!this.hasDropDown) {
			  		this.results=results;
			  		return ;
			  	}


			  	this.results=results;


			  },
			  dispatchItem(selected)
			  {
			  	this.selected=selected;
			  	this.results=null;
			  	this.emptySearch=false;
			  	this.query=this.makeInPutText(selected);
			  	this.$emit("selected",selected);


			  },


			  externalUpdate(result)
			  {

			  	if (!result) {
			  		this.updateInput(null);
			  		return ;
			  	}
			  	this.clearSelected();
			  	this.dispatchItem(result);


			  },

			  makeInPutText(result)
			  {
			  	let text="";
			  	this.attributes.forEach(attribute=>{
			  		let madeText=this.makeAttribute(result,attribute);
			  		if (madeText) {
			  			text+=madeText;
			  		}
			  		
			  	});
			  	return text;
			  },
			  /**
			   * Makes an attribute using the child and the result for the list item.
			   *
			   * @param      {Object}  result     
			   * @param      {Obejtc}  attribute  
			   * @return     {string}  
			   */
			   makeAttribute(result,attribute)
			   {

			   	result=this.processAttribute(result,attribute);

			   	let filter=attribute.filter;

			   	if(filter){
			   		result=this.$options.filters[filter](result);
			   	}

			   	if (attribute.prepends) {
			   		result=attribute.prepends +result;
			   	}
			   	if (attribute.appends) {
			   		result=result+ attribute.appends;
			   	}
			   	return result;
			   },
			  /**
			   * processes an attribute
			   *
			   * @param      {Object}  result     
			   * @param      {Object}  attribute  
			   * @return     {mixed}  
			   */
			   processAttribute(result,attribute)
			   {
			   	let dataName=attribute.dataName;


			   	if (!dataName) {
			   		return;
			   	}


			   	if (!dataName.includes(".")) {

			   		return result[dataName];
			   	}

			   	dataName.split(".").forEach((key)=>{
			   		result=result[key];
			   	});
			   	return result;



			   }

			},

			computed:{
			/**
			 * compute input icons states
			 *
			 * @return     {Object} 
			 */
			 icon()
			 {
			 	if (this.isInitial) {

			 		return {
			 			group:'',
			 			input:'',
			 			addon:"fa fa-search"
			 		}
			 	}
			 	if (this.isSearching) {
			 		return {
			 			group:'',
			 			input:'',
			 			addon:"fa fa-spinner fa-spin"
			 		}
			 	}
			 	
			 	if (this.emptySearch) {
			 		return {
			 			group:'has-warning',
			 			input:'form-control-warning',

			 		}
			 	}

			 	return {
			 		group:'has-success',
			 		input:'form-control-success',

			 	}

			 },

			/**
			 * appends the selected value as a query string the to the endpoint appropriately
			 *
			 * @return     {string}  
			 */
			 url()
			 {
			 	if (this.endPoint.includes("?")) {
			 		return `${this.endPoint}&query=${this.query}`;
			 	}
			 	return `${this.endPoint}?query=${this.query}`;

			 },

			 isInitial()
			 {
			 	return !this.query && !this.results;
			 }
			}
		}
	</script>
