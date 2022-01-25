const GRID_SIZE = 9;
            var solved = false;

            var board = [
                [0,0,0 , 0,0,0 , 0,0,0],
                [0,0,0 , 0,0,0 , 0,0,0],
                [0,0,0 , 0,0,0 , 0,0,0],
                
                [0,0,0 , 0,0,0 , 0,0,0],
                [0,0,0 , 0,0,0 , 0,0,0],
                [0,0,0 , 0,0,0 , 0,0,0],
                
                [0,0,0 , 0,0,0 , 0,0,0],
                [0,0,0 , 0,0,0 , 0,0,0],
                [0,0,0 , 0,0,0 , 0,0,0]
            ];

            var tmpBoard = [
                [0,0,0 , 0,0,0 , 0,0,0],
                [0,0,0 , 0,0,0 , 0,0,0],
                [0,0,0 , 0,0,0 , 0,0,0],
                
                [0,0,0 , 0,0,0 , 0,0,0],
                [0,0,0 , 0,0,0 , 0,0,0],
                [0,0,0 , 0,0,0 , 0,0,0],
                
                [0,0,0 , 0,0,0 , 0,0,0],
                [0,0,0 , 0,0,0 , 0,0,0],
                [0,0,0 , 0,0,0 , 0,0,0]
            ];

            var grid = new Array (9);
            for (var i = 0; i < GRID_SIZE; i++){
                grid[i] = new Array(9);
                for (var j = 0; j < GRID_SIZE; j++){
                    grid[i][j] = document.getElementById("i"+i+'-'+j);
                }
            }
            function loadValues(){
                if (!solved){
                    for (var i = 0; i < GRID_SIZE; i++){
                        for (var j = 0; j < GRID_SIZE; j++){
                            // if its not a number, return
                            if (isNaN(grid[i][j].value)){
                                document.getElementById("invalid").innerHTML = "Invalid number in the board matrix.";
                                document.getElementById("invalid").style.color = "red";
                                return; 
                            }
                            board[i][j] = grid[i][j].value;
                        }
                    }
                    // check sodoku validation
                    var isOk = isSodokuValid();
                    if (isOk == false){
                        return;
                    }
                    // save unsolved sodoku values 
                    copyGridToTmpBoard();
                    // solve sodoku
                    solve();

                    solved = true;
                    document.getElementById("solve").innerHTML = "Unsolve";
                } else {
                    document.getElementById("solve").innerHTML = "Solve";
                    solved = false;
                    // upload the saved unsolved sodoku to grid
                    for (var i = 0; i < GRID_SIZE; i++){
                        for (var j = 0; j < GRID_SIZE; j++){
                            grid[i][j].value = tmpBoard[i][j];
                        }
                    }
                }
            }


            function solve() {
                if (solveSodoku(board, 0, 0)){
                    uploadValuesToGrid();
                } else {
                    alert("the problem is wrong");
                }
            }

            function solveSodoku(board, row, col){
                var cell = findUnassignedLocation(board, row, col);
                row = cell[0];
                col = cell[1];
                if (row == -1){
                    return true;
                }

                for (var num = 1; num <= GRID_SIZE; num++){
                    if (isValidPlacement(board, row, col, num)){
                        board[row][col] = num;
                        if (solveSodoku(board, row, col)){
                            return true;
                        }
                        board[row][col] = 0;
                    }
                }
                return false;
            }

            function findUnassignedLocation(board, row, col){
                var done = false;
                var res = [-1, -1];

                while (!done) {
                    if (row == GRID_SIZE) {
                        done = true;
                    } else {
                        if (board[row][col] == 0){
                            res[0] = row;
                            res[1] = col;
                            done = true;
                        } else {
                            if (col < 8){
                                col++;
                            } else {
                                row++;
                                col = 0;
                            }
                        }
                    }
                }

                return res;
            }

            function isValidPlacement(board, row, col, num){
                return !isNumberInRow(board, num, row) &&
                        !isNumberInColumn(board, num, col) &&
                        !isNumberInBox(board, row, col, num);
            }

            function isNumberInRow(board, number, row){
                for (var i = 0; i < GRID_SIZE; i++){
                    if (board[row][i] == number){
                        return true;
                    }
                }
                return false;
            }
            
            function isNumberInColumn(board, number, column){
                for (var i = 0; i < GRID_SIZE; i++){
                    if (board[i][column] == number){
                        return true;
                    }
                }
                return false;
            }

            function isNumberInBox(board, row, column, number){
                var iBox = row - (row % 3);
                var jBox = column - (column % 3);

                for (var i = iBox; i < iBox + 3; i++){
                    for (var j = jBox; j < jBox + 3; j++){
                        if (board[i][j] == number){
                            return true;
                        }
                    }
                }
                return false;
            }
           



            function Reset(){
                for (var i = 0; i < GRID_SIZE; i++){
                    for (var j = 0; j < GRID_SIZE; j++){
                        grid[i][j].value = null;
                        board[i][j] = 0;
                    }
                }
                solved = false;
                document.getElementById("invalid").innerHTML = "";
                document.getElementById("solve").innerHTML = "Solve";
            }

            function copyGridToTmpBoard(){
                for (var i = 0; i < GRID_SIZE; i++){
                    for (var j = 0; j < GRID_SIZE; j++){
                        tmpBoard[i][j] = board[i][j];
                    }
                }
            }
        
            function alertBoard(){
                var msg = "";
                for (var i = 0; i < GRID_SIZE; i++){
                    for (var j = 0; j < GRID_SIZE; j++){
                        if (j % 3 == 0 && j != 0){
                            if (board[i][j] == 0){
                                msg += "|0";
                            } else {
                                msg += "|"+board[i][j];
                            }
                        } else {
                            if (board[i][j] == 0){
                                msg += "0";
                            } else {
                                msg += board[i][j];
                            }
                        }
                    }
                    msg += "\n";
                    if ((i+1) % 3 == 0){
                        msg += "-------------\n";
                    }
                }

                alert(msg);
            }

            function uploadValuesToGrid(){
                for (var i = 0; i < GRID_SIZE; i++){
                    for (var j = 0; j < GRID_SIZE; j++){
                        grid[i][j].value = board[i][j];
                    }
                }
            }

            function isSodokuValid(){
                // check rows
                var flag = [0,0,0,0,0,0,0,0,0,0];
                
                for (var i = 0; i < GRID_SIZE; i++){
                    for (var j = 0; j < GRID_SIZE; j++){
                        flag[board[i][j]]++;
                    }
                    for (var m = 1; m < flag.length; m++){
                        if (flag[m] > 1){
                            document.getElementById("invalid").innerHTML = "Identical numbers in a row "+i;
                            document.getElementById("invalid").style.color = "red";
                            return false;
                        } else {
                            flag[m] = 0;
                        }
                        
                    }
                }
                
                
                // check columns
                for (var i = 0; i < GRID_SIZE; i++){
                    for (var j = 0; j < GRID_SIZE; j++){
                        flag[board[j][i]]++;
                    }
                    for (var m = 1; m < flag.length; m++){
                        if (flag[m] > 1){
                            document.getElementById("invalid").innerHTML = "Identical numbers in a column "+i;
                            document.getElementById("invalid").style.color = "red";
                            return false;
                        } else {
                            flag[m] = 0;
                        }
                        
                    }
                }

                // check boxes
                for (var i = 0; i < GRID_SIZE; i += 3){
                    for (var j = 0; j < GRID_SIZE; j += 3){
                        for (x = i; x < i + 3; x++){
                            for (var y = j; y < j + 3; y++){
                                flag[board[x][y]]++;
                            }
                        }
                        for (var m = 1; m < flag.length; m++){
                            if (flag[m] > 1){
                                document.getElementById("invalid").innerHTML = "Identical numbers in a box. ";
                                document.getElementById("invalid").style.color = "red";
                                return false;
                            } else {
                                flag[m] = 0;
                            }
                        }  
                    }
                }

            }
            
            function resetArray(flag){
                for (var i = 0; i < flag.length; i++){
                    flag[i] = 0;
                }
            }