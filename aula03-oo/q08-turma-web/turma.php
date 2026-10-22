<?php

declare(strict_types=1);

class Aluno
{
    private string $nome;
    private float $nota1;
    private float $nota2;

    public function __construct(string $nome, float $nota1, float $nota2)
    {
        if ($nota1 < 0 || $nota1 > 10 || $nota2 < 0 || $nota2 > 10) {
            throw new Exception("Nota inválida para $nome: use valores de 0 a 10.");
        }

        $this->nome = $nome;
        $this->nota1 = $nota1;
        $this->nota2 = $nota2;
    }

    public function getNome(): string
    {
        return $this->nome;
    }

    public function calcularMedia(): float
    {
        return ($this->nota1 + $this->nota2) / 2;
    }

    public function situacao(): string
    {
        if ($this->calcularMedia() >= 7) {
            return "Aprovado";
        }

        return "Reprovado";
    }
}

class Disciplina
{
    private string $nome;
    private array $alunos = [];

    public function __construct(string $nome)
    {
        $this->nome = $nome;
    }

    public function getNome(): string
    {
        return $this->nome;
    }

    public function getAlunos(): array
    {
        return $this->alunos;
    }

    public function adicionarAluno(Aluno $aluno): void
    {
        $this->alunos[] = $aluno;
    }

    public function calcularMediaTurma(): float
    {
        if (count($this->alunos) === 0) {
            return 0.0;
        }

        $soma = 0;

        foreach ($this->alunos as $aluno) {
            $soma += $aluno->calcularMedia();
        }

        return $soma / count($this->alunos);
    }

    public function contarAprovados(): int
    {
        $aprovados = 0;

        foreach ($this->alunos as $aluno) {
            if ($aluno->situacao() === "Aprovado") {
                $aprovados++;
            }
        }

        return $aprovados;
    }
}

$pweb = new Disciplina("Programação Web I");

$pweb->adicionarAluno(new Aluno("Ana", 8.0, 9.5));
$pweb->adicionarAluno(new Aluno("Bruno", 5.0, 6.0));
$pweb->adicionarAluno(new Aluno("Caio", 2.5, 3.0));
$pweb->adicionarAluno(new Aluno("Daniela", 7.0, 7.0));

$mensagem = "";

if (isset($_GET["teste"]) && $_GET["teste"] === "1") {
    try {
        $pweb->adicionarAluno(new Aluno("Eduardo", 11.0, 8.0));
    } catch (Exception $erro) {
        $mensagem = $erro->getMessage();
    }
}

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Turma - Programação Web I</title>
</head>
<body>

    <?php if ($mensagem !== ""): ?>
        <p><?php echo htmlspecialchars($mensagem); ?></p>
    <?php endif; ?>

    <h1><?php echo htmlspecialchars($pweb->getNome()); ?></h1>

    <table border="1">
        <tr>
            <th>Aluno</th>
            <th>Média</th>
            <th>Situação</th>
        </tr>

        <?php foreach ($pweb->getAlunos() as $aluno): ?>
            <tr>
                <td><?php echo htmlspecialchars($aluno->getNome()); ?></td>
                <td><?php echo number_format($aluno->calcularMedia(), 2, ',', '.'); ?></td>
                <td><?php echo $aluno->situacao(); ?></td>
            </tr>
        <?php endforeach; ?>

    </table>

    <p>
        Média da turma:
        <?php echo number_format($pweb->calcularMediaTurma(), 2, ',', '.'); ?>
    </p>

    <p>
        Aprovados:
        <?php echo $pweb->contarAprovados(); ?>
        de
        <?php echo count($pweb->getAlunos()); ?>
    </p>

</body>
</html>
