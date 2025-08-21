const fs = require('fs').promises;
const path = require('path');

class IncrementVersionPlugin {
    constructor() {
        this.version = '0.1';
        this.rootPath = path.resolve(__dirname, './'); // Получаем корневую директорию
        this.report = [];
    }

    apply(compiler) {  
        compiler.hooks.emit.tapPromise('IncrementVersionPlugin', async (compilation) => {
            try {
                const startTime = Date.now();
                this.report.push('--- НАЧАЛО РАБОТЫ ПЛАГИНА ---');
 
                // Формируем пути
                const phpFilePath = path.join(this.rootPath, '/functions', 'functions_scripts.php');
                const cssFilePath = path.join(this.rootPath, 'style.css');
                const readmeFilePath = path.join(this.rootPath, '../../../README.md');
                
                this.report.push('Проверяемые пути:');
                this.report.push(`PHP файл: ${phpFilePath}`);
                this.report.push(`CSS файл: ${cssFilePath}`);
                this.report.push(`README файл: ${readmeFilePath}`);
 
                // Проверяем существование файлов
                const stats = await fs.stat(phpFilePath);
                this.report.push(`Файл существует: ${stats.isFile()}`);
 
                // Читаем текущую версию
                const data = await fs.readFile(phpFilePath, 'utf8');
                const match = data.match(/\s*\$ver\s*=\s*['"](\d+\.\d+)['"]/);
 
                if (match) {
                    this.version = this.incrementVersion(match[1]);
                    this.report.push(`Найденная версия: ${match[1]}`);
                    this.report.push(`Новая версия: ${this.version}`);
 
                    // Обновляем файлы
                    await this.updatePHPFile(phpFilePath, this.version, 'functions_scripts.php');
                    await this.updateFile(cssFilePath, this.version, 'style.css');
                    await this.updateFile(readmeFilePath, this.version, 'README.md');
 
                } else {
                    this.report.push('Версия не найдена в PHP файле!');
                }
 
                const endTime = Date.now();
                this.report.push(`Время выполнения: ${endTime - startTime} мс`);
                this.report.push('--- КОНЕЦ РАБОТЫ ПЛАГИНА ---');
                
                console.log(this.report.join('\n'));
 
            } catch (error) {
                this.report.push('--- ОШИБКА В РАБОТЕ ПЛАГИНА ---');
                this.report.push('Произошла ошибка:');
                this.report.push(error.message);
                this.report.push('--- КОНЕЦ ОТЧЕТА ОБ ОШИБКЕ ---');
                console.error(this.report.join('\n'));
            }
        });
    }

    async updatePHPFile(filePath, version) {
        try {
            const data = await fs.readFile(filePath, 'utf8');
            // Находим тип кавычек в исходном файле
            const quote = data.match(/['"]/)[0];
            // Создаем регулярное выражение с учетом найденных кавычек
            const regex = new RegExp(`\\s*\\$ver\\s*=\\s*${quote}(\\d+\\.\\d+)${quote}`);
            const newData = data.replace(
                regex,
                `$ver = ${quote}${version}${quote}`
            );
            await fs.writeFile(filePath, newData);
            this.report.push(`Успешно обновлен PHP файл: ${path.basename(filePath)}`);
        } catch (error) {
            this.report.push(`Ошибка при обновлении PHP файла:`);
            this.report.push(error.message);
        }
    }

    async updateFile(filePath, version, fileName) {
        try {
            const data = await fs.readFile(filePath, 'utf8');
            const newData = data.replace(
                /(Version:\s*|Version\s*)\d+\.\d+/g,
                `$1${version}`
            );
            await fs.writeFile(filePath, newData);
            this.report.push(`Успешно обновлен файл: ${fileName}`);
        } catch (error) {
            this.report.push(`Ошибка при обновлении файла ${fileName}:`);
            this.report.push(error.message);
        }
    }

    incrementVersion(version) {
        const [major, minor] = version.split('.').map(Number);
        return `${major}.${minor + 1}`;
    }
}

module.exports = IncrementVersionPlugin;
