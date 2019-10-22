import React from 'react';
import { DataGrid, GridColumn } from 'rc-easyui';
import PostData from '../../data/argritronics.json';
 
class SensorGrid extends React.Component {
 constructor(props) {
     super(props);
     this.state = {
       total: 0,
       pageSize: 20,
       pagePosition: "top",
       data: PostData
    }
  }

  getCellCssTemp(row, value) {
    if (value === 999) { row.temperature = "-";
    } else if (value > 35 ) { return { background: "#cc9900",color:"#000000" };}
    return null;
  } 

  getCellCssHum(row, value) {
    if (value === 999) { row.humidity = "-"; } 
    else if (value > 50 ) { return { background: "#0099cc",color:"#ffffff" };}
    return null;
  }

  getCellCssRain(row, value) {
    if (value === 999) { row.rain = "-";} 
    else if (value > 2 ) { return { background: "#ff66cc",color:"#000000" };}
    return null;
 }

 getCellCssPar (row, value) {
	if (value === 999) { row.par = "-"; } 
	else if (value > 700) { return { background: "#cccc00",color:"#000000"};}
 }

 getCellCssWS (row, value) {
	if (value === 999) { row.windspeed = "-"; } 
	else if (value > 30) { return { background: "#99ccff",color:"#000000"};}
 }

 getCellCssWD (row, value ) {
	 if ( value === 999) { row.windirection = "-";}
 }

 getCellCssBar (row, value ) {
	 if ( value === 999) { row.barometer = "-";}
 }

  render() {
    return (
      <div>
        <DataGrid data={this.state.data} rowCss={this.getRowCss} style={{ height: 700,width: 800 }} pagination{...this.state}>
          <GridColumn field="station" title="Station ID" align="center"></GridColumn>
          <GridColumn field="par" title="Par" align="center" cellCss={this.getCellCssPar}></GridColumn>
          <GridColumn field="temperature" title="Temperature" align="center" cellCss={this.getCellCssTemp}></GridColumn>
          <GridColumn field="rain" title="Rain" align="center" cellCss={this.getCellCssRain}></GridColumn>
          <GridColumn field="humidity" title="Humidity" align="center" cellCss={this.getCellCssHum}></GridColumn>
          <GridColumn field="windspeed" title="Wind Speed" align="center" cellCss={this.getCellCssWS}></GridColumn>
          <GridColumn field="winddirection" title="Wind Direction" align="center" cellCss={this.getCellCssWD}></GridColumn>
          <GridColumn field="barometer" title="Barometer" align="center" cellCss={this.getCellCssBar}></GridColumn>
        </DataGrid>
      </div>
    );
  }
}
export default SensorGrid;
