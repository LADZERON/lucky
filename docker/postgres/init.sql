-- Инициализация базы данных для проекта Lucky
-- Этот файл выполняется при первом запуске контейнера PostgreSQL

-- Создание расширений
CREATE EXTENSION IF NOT EXISTS "uuid-ossp";
CREATE EXTENSION IF NOT EXISTS "pg_trgm";
CREATE EXTENSION IF NOT EXISTS "unaccent";

-- Настройка локали для поиска
SET default_text_search_config = 'simple';

-- Создание индексов для оптимизации (будут созданы после миграций Laravel)
-- Эти команды выполнятся после запуска Laravel миграций

-- Настройки для разработки
ALTER DATABASE lucky_db SET timezone TO 'UTC';
ALTER DATABASE lucky_db SET default_text_search_config = 'simple';

-- Комментарий для информации
COMMENT ON DATABASE lucky_db IS 'База данных для проекта Lucky - Laravel приложение';
