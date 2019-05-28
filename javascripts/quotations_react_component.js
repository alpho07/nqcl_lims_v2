'use strict';

const e = React.createElement;
const quotationNumbers = [];



class QuotationTr extends React.Component{
	
	//Define constructor
	constructor(props){
		super(props);
		this.state = {term:"", quotationNumbers:[]};
	}


	//set state
	getSuggestions(event){
		this.setState({term:event.target.value, quotationNumbers:this.getQuotationNumbers(event.target.value)});
	}

	//get suggestions
	getQuotationNumbers(term){
		Axios.get('').
		then().catch()
	}

	//Render function
	render(){
		return e('div', null, [e('input', {onChange:(f)=> this.getSuggestions(f)})]);
		//return 	<input type="text" name="quotation_no" value="{this.state.term}" onChange={this.getSuggestions.bind()}
	}

	//get input and send to async function
	

}

const domContainer = document.querySelector('#quotation_no');
console.log(domContainer)
ReactDOM.render(e(QuotationTr), domContainer);