export default class BaseDataStructure
{
	constructor(structure)
	{
		this.fields=structure;
	}
	plain()
	{
		return this.fields;
	}

	binded(model)
	{
		return this.fields.map((field)=>{
			field.value=model[field.name];
			return field;
		})
	}
}