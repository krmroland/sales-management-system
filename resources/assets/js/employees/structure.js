
import BaseDataStructure from "../BaseDataStructure"

class structure extends BaseDataStructure
{
	constructor()
	{
		super([
				{
					name:'name',
					label:'The name of the employee'
				},
			
				{
					name:"phoneNumber",
					label:'The Employees phone number',

				},
				{
					name:"responsibility",
					label:"The employees' responsibility eg Maganager, Cahsier etc",
				},
				{
					name:"sex",
					options:['male','female'],
					label:"The employees sex"
				}

				]);
	}

}

export default structure;