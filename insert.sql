

INSERT INTO Perfiles values (0,"ADMINISTRADORXS");
INSERT INTO Perfiles values (1,"COORDINADORXS");
INSERT INTO Perfiles values (2,"PROFESORXS");
INSERT INTO Perfiles values (3,"MONITORXS");


INSERT INTO Usuarios values ("1234","1234","ROOT","root@correounivale.edu.co",0,0);

INSERT INTO Usuarios values ("4567","4567","COORDINADOR","coordinador@correounivale.edu.co",0,1);

INSERT INTO Usuarios values ("789","789","DOCENTE-PRUEBA","docente-prueba@correounivale.edu.co",0,2);


INSERT INTO Asignaturas values("ABCD","ASIGNATURA-PRUEBA1",4,4,"D");
INSERT INTO Asignaturas values("EFGH","ASIGNATURA-PRUEBA2",3,3,"N");


INSERT INTO Dependencias values("0001","DEPENDENCIA 1","4567");
INSERT INTO Dependencias values("0002","DEPENDENCIA 2","4567");

INSERT INTO Asignatura_dependencia values("ABCD","0001",1);
INSERT INTO Asignatura_dependencia values("EFGH","0002",2);


INSERT INTO Horarios values (1,1,"JUEVES",TIME('8:00'),4,"789");
INSERT INTO Horarios values (2,2,"JUEVES",TIME('14:00'),3,"789");
