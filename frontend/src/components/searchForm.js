import React, {PropTypes, Component} from 'react'
import {fetchSearchData} from '../actions/search'

class SearchForm extends Component {
    constructor(props) {
        super(props);
        this.state = {
            value: props.value,
            list: props.list
        };

        this.handleSubmit = this.handleSubmit.bind(this);
        this.handleChange = this.handleChange.bind(this);
    }

    handleSubmit(e) {
        e.preventDefault();
        fetchSearchData()
          .then((data) => {
            this.props.setList(data)
          })
          .catch((err) => {
            console.error('err', err);
          });
    }

    handleChange(event) {
        this.setState({
            value: event.target.value,
            list: []
        });
    }

    render() {
        return (
            <form name="search_form" onSubmit={this.handleSubmit}>
                <label>
                    Search object:
                    <input type="text" value={this.state.value} onChange={this.handleChange}/>
                </label>
                <input type="submit" value="Ok"/>
            </form>
        );
    }
}

export default SearchForm;