CREATE TABLE Aluno (
    RA int PRIMARY KEY,
    Nome VARCHAR(255),
    senha VARCHAR(255)   
);

CREATE TABLE Professor (
    ID INT PRIMARY KEY,
    Nome VARCHAR(255),
    senha VARCHAR(20)
);

CREATE TABLE Materia (
    ID INT PRIMARY KEY,
    NomeMateria VARCHAR(255)
);

CREATE TABLE Paciente (
    ID INT PRIMARY KEY AUTO_INCREMENT,
    Nome VARCHAR(255),
    email VARCHAR(255),
    tel VARCHAR(15),
    tel2 VARCHAR(15),
    MateriaID INT,
    FOREIGN KEY (MateriaID) REFERENCES Materia(ID)
);

CREATE TABLE Aluno_Materia (
    ID INT PRIMARY KEY,
    AlunoID INT,
    MateriaID INT,
    FOREIGN KEY (AlunoID) REFERENCES Aluno(RA),
    FOREIGN KEY (MateriaID) REFERENCES Materia(ID)
);

CREATE TABLE Professor_Materia (
    ID INT PRIMARY KEY AUTO_INCREMENT,
    ProfessorID INT,
    MateriaID INT,
    FOREIGN KEY (ProfessorID) REFERENCES Professor(ID),
    FOREIGN KEY (MateriaID) REFERENCES Materia(ID)
);
