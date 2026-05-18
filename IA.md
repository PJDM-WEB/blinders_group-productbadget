# Uso de IA en este proyecto

## 1. Herramientas utilizadas

| Herramienta | Versión / Modelo | Modo de uso | Aprox. % del trabajo |
|---|---|---|---|
| (ej. Claude Code CLI) | (ej. 4.7 Opus) | (ej. terminal en VS Code) | (ej. 60%) |
| (ej. ChatGPT web) | (ej. GPT-5) | (consultas puntuales) | (ej. 10%) |
| Ninguna | — | (yo mismo, sin IA) | (ej. 30%) |

## 2. Configuración del proyecto

### CLAUDE.md / AGENTS.md
¿Tienes archivo de instrucciones a nivel proyecto? Pega aquí su contenido o
linka al fichero del repo. Si no tienes, escribe "ninguno" y explica por qué.

### settings.json u otra configuración equivalente
¿Cambiaste permisos, modelo activo, herramientas habilitadas/bloqueadas?
Adjunta el archivo al repo y referencia aquí su ruta.

## 3. Skills personalizadas

Si usaste skills (propias o de terceros), lístalas:

- Nombre del skill
- Origen (propia, de la comunidad, adaptada)
- Para qué la usaste en este proyecto
- Ruta dentro del repo

Si no usaste ninguna, "ninguna".

## 4. Slash commands personalizados

Si tienes comandos custom (`/revisa-modulo`, `/genera-hook`...), lístalos
de la misma forma. Deben estar en `.claude/commands/` o equivalente.

## 5. Sub-agentes invocados

¿Usaste Task tool, Plan Mode, sub-agentes? Indica para qué los usaste y si
guardaste sus definiciones en el repo (`.claude/agents/`).

## 6. MCPs (Model Context Protocol)

¿Conectaste algún MCP server durante el trabajo?

| MCP | Para qué lo usaste | ¿Qué te aportó? |
|---|---|---|
| (ej. filesystem) | (lectura del repo) | (navegación más rápida) |
| (ej. github) | — | (no lo usé) |
| (ej. context7) | (docs de PrestaShop) | (evitó alucinaciones en hooks) |

Si no usaste ninguno, dilo y explica si lo habrías usado con más tiempo.

## 7. Prompts importantes

Lista los 5-10 prompts más relevantes (no todos, los que dieron forma al
proyecto). Por cada uno:

### Prompt N
- **Herramienta:** (Claude Code / ChatGPT / ...)
- **Prompt:** (copia textual)
- **Qué generó (resumen):**
- **Qué hice con el output:** (acepté tal cual / modifiqué X / descarté
  porque...)

## 8. Errores de la IA que detecté

Lista bugs, invenciones, malas prácticas o riesgos de seguridad que la IA
introdujo y tú corregiste. Por cada uno:

- **Qué generó la IA (mal):**
- **Por qué estaba mal:**
- **Cómo lo corregiste:**

Si dices "ninguno", piénsalo dos veces. En PrestaShop 1.7 la IA suele
equivocarse en cosas concretas. Si realmente no detectaste nada, dilo y
reflexiona sobre qué podría haber pasado.

## 9. Partes que NO usé IA

Indica qué partes hiciste totalmente a mano y por qué decidiste no usar IA
en ellas.

## 10. Reflexión final

- ¿Qué te ahorró la IA en este ejercicio?
- ¿En qué te entorpeció o te llevó por mal camino?
- ¿Qué cambiarías de tu flujo con IA si lo repitieras?
