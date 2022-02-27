import { Component, OnInit } from '@angular/core';
import { partida } from 'src/app/models/partida';
import { PartidaService } from 'src/app/services/partida.service';

@Component({
  selector: 'app-juego',
  templateUrl: './juego.component.html',
  styleUrls: ['./juego.component.css']
})
export class JuegoComponent implements OnInit {

  partida:partida = new partida();
  casilla1:string = "./assets/blanco.png";
  casilla2:string = "./assets/blanco.png";
  casilla3:string = "./assets/blanco.png";
  casilla4:string = "./assets/blanco.png";
  casilla5:string = "./assets/blanco.png";
  casilla6:string = "./assets/blanco.png";
  casilla7:string = "./assets/blanco.png";
  casilla8:string = "./assets/blanco.png";
  casilla9:string = "./assets/blanco.png";
  pantalla:string = "d-none";
  resultado:string = "Empate!!";
  casillasJugadas:Array<number> = [];
  turno:string = "./assets/xAzul.png";

  constructor(private partidaService: PartidaService) { }

  ngOnInit(): void {
    this.partida = this.partidaService.getPartida();
    //this.pedirSudoku();
  }

  reiniciar() {
    window.location.reload();
  }

  pedirJugada(tablero:string) {
    fetch("https://stujo-tic-tac-toe-stujo-v1.p.rapidapi.com/"+tablero+"/O", {
      "method": "GET",
      "headers": {
        "x-rapidapi-host": "stujo-tic-tac-toe-stujo-v1.p.rapidapi.com",
        "x-rapidapi-key": "caaa33a487msh539fb2ad03f72fap1d5463jsn0256438b22c1"
      }
    })
    .then(response => response.json())
    .then(response => {
      this.casillasJugadas.push(response.recommendation + 1);
      switch(response.recommendation + 1) {
        case 1: this.casilla1 = "./assets/circuloVerde.png"; break;
        case 2: this.casilla2 = "./assets/circuloVerde.png"; break;
        case 3: this.casilla3 = "./assets/circuloVerde.png"; break;
        case 4: this.casilla4 = "./assets/circuloVerde.png"; break;
        case 5: this.casilla5 = "./assets/circuloVerde.png"; break;
        case 6: this.casilla6 = "./assets/circuloVerde.png"; break;
        case 7: this.casilla7 = "./assets/circuloVerde.png"; break;
        case 8: this.casilla8 = "./assets/circuloVerde.png"; break;
        case 9: this.casilla9 = "./assets/circuloVerde.png"; break;
      }

      let auxTablero:Array<string> = this.partida.tablero.split('');
      auxTablero[response.recommendation] = "O";
      let newTablero:string = "";
      auxTablero.forEach(element => {
        newTablero = newTablero + element;
      });
      return newTablero;
      
    }).then(response => {
      this.partida.tablero = response;
      let comprobacion:string = this.comprobarTablero(this.partida.tablero);
        
      if(comprobacion == "nadie") {
        this.pantalla = "d-none";
      } else {
        this.partida.finalizada = !this.partida.finalizada;
        if(comprobacion == 'X') {
          this.resultado = 'Has Ganado!';
        } else {
          this.resultado = 'Has Perdido!';
        }
      }
      
    })
    .catch(err => {
      console.error(err);
    });

  }

  jugar(pos: number) {
    if(!this.casillasJugadas.includes(pos)) {
      this.casillasJugadas.push(pos);
      let img = "";
      if(this.partida.turno == 'X') {
        img = './assets/xAzul.png';
        this.turno = './assets/circuloVerde.png';
      } else {
        img = './assets/circuloVerde.png';
        this.turno = './assets/xAzul.png';
      }
      switch(pos) {
        case 1: this.casilla1 = img; break;
        case 2: this.casilla2 = img; break;
        case 3: this.casilla3 = img; break;
        case 4: this.casilla4 = img; break;
        case 5: this.casilla5 = img; break;
        case 6: this.casilla6 = img; break;
        case 7: this.casilla7 = img; break;
        case 8: this.casilla8 = img; break;
        case 9: this.casilla9 = img; break;
      }
      let auxTablero:Array<string> = this.partida.tablero.split('');
      auxTablero[pos-1] = this.partida.turno;
      let newTablero:string = "";
      auxTablero.forEach(element => {
        newTablero = newTablero + element;
      });
      this.partida.tablero = newTablero;
  
      let comprobacion:string = this.comprobarTablero(this.partida.tablero);
  
      if(comprobacion == "nadie") {
        console.log(this.casillasJugadas.length);
        if(this.casillasJugadas.length != 9) {
          if(this.partida.jugadores == 1) {
            this.pantalla = "d-flex";
            this.pedirJugada(this.partida.tablero);
          } else {
            if(this.partida.turno == 'X') {
              this.partida.turno = 'O';
            } else {
              this.partida.turno = 'X';
            }
          }
        } else {
          this.final(comprobacion);
        }
        
      } else {
        this.final(comprobacion);
      }
    }
  }

  final(comprobacion:string) {
    this.pantalla = "d-flex";
    this.partida.finalizada = !this.partida.finalizada;
    if(this.partida.jugadores == 1) {
      if(comprobacion == 'X') {
        this.resultado = 'Has Ganado!';
      }
      if(comprobacion == 'O') {
        this.resultado = 'Has Perdido!';
      }
    } else {
      if(comprobacion == 'X') {
        this.resultado = 'Gana el jugador 1!';
      } 
      if(comprobacion == 'O') {
        this.resultado = 'Gana el jugador 2!';
      }
    }

    if(comprobacion == 'nadie') {
      this.resultado = 'Empate!';
    }
  }

  comprobarTablero(tablero:string):string {
    let resp = "nadie";
    let combinaciones:Array<string> = ["012","345","678","036","147","258","048","246"];
    combinaciones.forEach(element => {
      let aux = element.split('');
      let tableroAux = tablero.split('');
      if(tableroAux[parseInt(aux[0])]=='X' && tableroAux[parseInt(aux[1])]=='X' && tableroAux[parseInt(aux[2])]=='X') {
        resp = 'X';
      }
      if(tableroAux[parseInt(aux[0])]=='O' && tableroAux[parseInt(aux[1])]=='O' && tableroAux[parseInt(aux[2])]=='O') {
        resp = 'O';
      }
    });
    return resp;
  }
}
