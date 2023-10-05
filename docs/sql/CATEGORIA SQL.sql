
--Listar todos los registros por Sucursal
ALTER PROCEDURE [dbo].[SP_L_CATEGORIA_01]  
@SUC_ID INT  
AS  
BEGIN  
 SELECT 
	 CAT_ID,
	 SUC_ID,
	 CAT_NOM,
	 CONVERT(VARCHAR,FECH_CREA,103) AS FECH_CREA,
	 EST 
 FROM 
	TM_CATEGORIA  
 WHERE  
	 SUC_ID = @SUC_ID  
	 AND EST=1  

--Obtener registro por ID
CREATE PROCEDURE SP_L_CATEGORIA_02
@CAT_ID INT
AS
BEGIN
	SELECT * FROM TM_CATEGORIA
	WHERE
	CAT_ID = @CAT_ID
END

--Eliminar Registro
CREATE PROCEDURE SP_D_CATEGORIA_01
@CAT_ID INT
AS
BEGIN
	UPDATE TM_CATEGORIA
	SET
		EST= 0
	WHERE
		CAT_ID = @CAT_ID
END

--REGISTRAR NUEVO REGISTRO
CREATE PROCEDURE SP_I_CATEGORIA_01
@SUC_ID INT,
@CAT_NOM VARCHAR(150)
AS
BEGIN
	INSERT INTO TM_CATEGORIA
	(SUC_ID,CAT_NOM,FECH_CREA,EST)
	VALUES
	(@SUC_ID,@CAT_NOM,GETDATE(),1)
END

--ACTUALIZAR REGISTRO
CREATE PROCEDURE SP_U_CATEGORIA_01
@CAT_ID INT,
@SUC_ID INT,
@CAT_NOM VARCHAR(150)
AS
BEGIN
	UPDATE TM_CATEGORIA
	SET
		SUC_ID = @SUC_ID,
		CAT_NOM = @CAT_NOM
	WHERE
		CAT_ID = @CAT_ID
END