import React, {Component} from 'react'

class SearchList extends Component {
    constructor(props) {
        super(props);

        this.state = {
            search: []
        }
    };

    render() {
console.log('test ' + this.props.search);
        return (
            <table>
                <tbody>
                {this.props.search && this.props.search.map(s => {
                    return (
                        <tr key={s.id}>
                            <td>{s.price}</td>
                            <td>{s.headline}</td>
                        </tr>
                    )
                })}
                </tbody>
            </table>


        );
    }
}

export default SearchList;