import React, {PropTypes, Component} from 'react'

export default class Page extends Component {
  onBtnClick(e) {
    this.props.setValue(+e.target.innerText)
  }

  render() {
    const {value} = this.props;

    return <div>
      <p>
        <button onClick={::this.onBtnClick}>2016</button>
        <button onClick={::this.onBtnClick}>2015</button>
        <button onClick={::this.onBtnClick}>2014</button>
      </p>
      <h3>{value} data</h3>
    </div>
  }
}

